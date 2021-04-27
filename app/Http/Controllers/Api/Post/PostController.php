<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use App\Models\Post\PostImage;
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
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string',
            'image_ids'     =>  'nullable|array',
        ]);

        $user = $request->user();

        $postStatus = 0;
        if (! config('SYSTEM_UGC_AUDIT', true)) $postStatus = 1;
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

        return new PostResource($post);
    }
}
