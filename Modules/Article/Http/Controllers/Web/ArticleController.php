<?php

namespace Modules\Article\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Modules\Article\Entities\Article;

class ArticleController extends Controller
{
    /**
     * 文章列表页
     */
    public function index()
    {
        $articles = Article::latest()->paginate();

        return view('article::web.index', compact('articles'));
    }

    /**
     * 文章详情页
     */
    public function show(Article $article)
    {
        return view('article::web.show', compact('article'));
    }
}
