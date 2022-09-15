<?php

namespace Modules\Post\Http\Controllers\Web;

use Modules\Post\Entities\Post;
use Modules\Post\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * 首页面
     */
    public function index()
    {
        $posts = Post::where('status', '1')->latest()->paginate();

        $lastCreatePost = Post::orderBy('created_at', 'desc')->first();
        $lastUpdatePost = Post::orderBy('updated_at', 'desc')->first();

        return view('post::web.index', compact('posts', 'lastCreatePost', 'lastUpdatePost'));
    }

    /**
     * 详情页面
     */
    public function show(Post $post)
    {
        return view('post::web.show', compact('post'));
    }
}
