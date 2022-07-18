<?php

namespace Modules\Post\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Modules\Post\Entities\Post;

class PostController extends Controller
{
    /**
     * 首页面
     */
    public function index()
    {
        $posts = Post::where('status', '1')->latest()->paginate();

        return view('post::web.index', compact('posts'));
    }
}
