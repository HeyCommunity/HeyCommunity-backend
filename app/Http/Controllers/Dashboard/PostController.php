<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate();

        return view('dashboard.posts.index', compact('posts'));
    }
}
