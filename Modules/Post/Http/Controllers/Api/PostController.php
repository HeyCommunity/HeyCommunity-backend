<?php

namespace Modules\Post\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostImage;
use Modules\Post\Entities\PostVideo;
use Modules\Post\Transformers\PostResource;

class PostController extends Controller
{
    /**
     * Index.
     */
    public function index(Request $request)
    {
        $posts = Post::where('status', '1')->latest()->paginate();

        return PostResource::collection($posts);
    }

    /**
     * 用户的动态列表.
     */
    public function userPosts(Request $request)
    {
        $request->validate(['user_id' => 'required|integer']);

        $posts = Post::where('status', '1')->where('user_id', $request->get('user_id'))->latest()->paginate();

        return PostResource::collection($posts);
    }

    /**
     * Show.
     */
    public function show(Request $request, Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Store.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string',
            'image_ids'     =>  'nullable|array',
            'video_id'      =>  'nullable|integer',
        ]);

        // 小程序 内容安全检测
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkText($request->get('content'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '动态内容包含违规敏感信息',
            ], 403);
        }

        $user = $request->user();

        $post = Post::create([
            'user_id'   =>  $user->id,
            'content'   =>  $request->get('content'),
            'status'    =>  1,
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
     * Hidden.
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
     * Destroy.
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
     * Upload video.
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

    /**
     * Upload image.
     */
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'file'      =>  'required|image',
        ]);

        // 小程序 内容安全检测
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkImage($request->file('file'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '图片涉及违规敏感信息',
            ], 403);
        }

        $user = $request->user();

        $postImage = PostImage::create([
            'user_id'       =>  $user->id,
            'file_path'     =>  $request->file('file')->store('uploads/posts/images'),
        ]);

        return new \App\Http\Resources\CommonResource($postImage);
    }
}
