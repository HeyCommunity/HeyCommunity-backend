<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use App\Models\Post\PostImage;
use App\Models\Post\PostVideo;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Index
     */
    public function index(Request $request)
    {
        $posts = Post::where('status', '1')->latest()->paginate();

        return PostResource::collection($posts);
    }

    /**
     * Show
     */
    public function show(Request $request, Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string',
            'image_ids'     =>  'nullable|array',
            'video_id'      =>  'nullable|integer',
        ]);

        $user = $request->user();

        $postStatus = 0;
        if (! config('system.ugc_audit', true)) $postStatus = 1;
        if ($user->is_admin || $user->ugc_safety_level) $postStatus = 1;

        $post = Post::create([
            'user_id'   =>  $user->id,
            'content'   =>  $request->get('content'),
            'status'    =>  $postStatus,
        ]);

        if ($request->get('image_ids')) {
            PostImage::whereIn('id', $request->get('image_ids'))->update([
                'post_id'   =>  $post->id,
            ]);
        }

        if ($request->get('video_id')) {
            PostVideo::where('id', $request->get('video_id'))->update([
                'post_id'   =>  $post->id,
            ]);
        }

        $post->refresh();
        return new PostResource($post);
    }

    /**
     * Hidden
     */
    public function hidden(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $user = $request->user();
        $post = Post::findOrFail($request->get('id'));

        //  判断是作者或管理员
        if ($user->is_admin) {
            $post->update(['status' => 2]);

            return new PostResource($post);
        } else {
            return response()->json(['message' => '无权执行此操作'], 403);
        }
    }

    /**
     * Destroy
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $user = $request->user();
        $post = Post::findOrFail($request->get('id'));

        //  判断是作者或管理员
        if ($post->user_id === $user->id || $user->is_admin) {
            $post->delete();

            return response()->json(['message' => '操作成功'], 202);
        } else {
            return response()->json(['message' => '无权执行此操作'], 403);
        }
    }

    /**
     *
     */
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file'      =>  'required|mimetypes:video/*',
            'duration'  =>  'required|numeric',
            'size'      =>  'required|integer',
            'width'     =>  'required|integer',
            'height'    =>  'required|integer',
        ]);

        $user = $request->user();

        $postVideo = PostVideo::create([
            'user_id'       =>  $user->id,
            'duration'      =>  round($request->get('duration')),
            'size'          =>  $request->get('size'),
            'height'        =>  $request->get('height'),
            'width'         =>  $request->get('width'),
            'file_path'     =>  $request->file('file')->store('uploads/posts/videos'),
        ]);

        return new \App\Http\Resources\CommonResource($postVideo);
    }
}
