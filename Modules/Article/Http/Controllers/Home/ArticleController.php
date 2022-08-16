<?php

namespace Modules\Article\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use function view;

class ArticleController extends Controller
{
    /**
     * Index
     */
    public function index()
    {
        $recommendArticles = Article::limit(3)->get();
        $latestArticles = Article::latest()->limit(3)->get();

        return view('article::home.index', compact('recommendArticles', 'latestArticles'));
    }

    /**
     * List
     */
    public function list(Request $request)
    {
        $request->validate([
            'slug'      =>  'string',
        ]);

        $categories = ArticleCategory::get();

        $articleQuery = Article::query();
        if ($request->get('slug')) {
            $articleQuery->whereHas('categories', function ($query) use ($request) {
                $query->where('slug', $request->get('slug'));
            });
        }
        $articles = $articleQuery->latest()->paginate(12)->appends(['slug' => $request->get('slug')]);

        return view('article::home.list', compact('categories', 'articles'));
    }

    /**
     * Show
     */
    public function show(Article $article)
    {
        return view('article::home.show', compact('article'));
    }
}
