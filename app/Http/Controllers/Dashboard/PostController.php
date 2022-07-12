<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;

class PostController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $posts = Post::with([
            'user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
            'video' => function ($query) {
                $query->select('id', 'post_id', 'file_path');
            },
            'images' => function ($query) {
                $query->select('id', 'post_id', 'file_path');
            },
        ])->latest()->paginate();

        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * 详情页
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', compact('post'));
    }
}
