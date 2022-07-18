<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Modules\Post\Entities\Post;

class HomeController extends Controller
{
    /**
     * 首页页
     */
    public function index()
    {
        $posts = Post::latest()->paginate();

        return view('web.home.index', compact('posts'));
    }
}
