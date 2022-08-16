<?php

namespace Modules\Article\Http\Controllers\Api;

use App\Http\Resources\CommonResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Transformers\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Index
     */
    public function index(Request $request)
    {
        $request->validate([
            'category_id'   =>  'nullable|integer',
        ]);

        $articleQuery = Article::where('status', 1)->latest();

        if ($request->get('category_id')) {
            $articleQuery->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->get('category_id'));
            });
        }

        $articles = $articleQuery->paginate();

        return ArticleResource::collection($articles);
    }

    /**
     *　Show
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Latest 5 item
     */
    public function latest5(Request $request)
    {
        $articles = Article::where('status', 1)->latest()->limit(5)->get();

        return ArticleResource::collection($articles);
    }

    /**
     * 分类
     */
    public function categories(Request $request)
    {
        $articleCategories = ArticleCategory::get();

        return CommonResource::collection($articleCategories);
    }
}
