<?php

namespace Modules\Article\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Entities\ArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $articleCategories = ArticleCategory::paginate();

        return view('article::dashboard.article-categories.index', compact('articleCategories'));
    }

    /**
     * 创建页
     */
    public function create()
    {
        $articleCategory = new ArticleCategory();

        return view('article::dashboard.article-categories.create', compact('articleCategory'));
    }

    /**
     * 新增处理
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug'          =>  'required|string',
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
        ]);

        $articleCategory = ArticleCategory::create([
            'slug'          =>  $request->get('slug'),
            'name'          =>  $request->get('name'),
            'description'   =>  $request->get('description'),
        ]);

        if ($articleCategory) {
            flash('创建文章分类成功')->success();
            return redirect()->route('dashboard.article-categories.index');
        } else {
            flash('创建文章分类成功')->error();
            return back()->withInput();
        }
    }

    /**
     * 编辑页
     */
    public function edit(ArticleCategory $articleCategory)
    {
        return view('article::dashboard.article-categories.edit', compact('articleCategory'));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $request->validate([
            'slug'          =>  'required|string',
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
        ]);

        $articleCategory->setAttribute('slug', $request->get('slug'));
        $articleCategory->setAttribute('name', $request->get('name'));
        $articleCategory->setAttribute('description', $request->get('description'));

        if ($articleCategory->save()) {
            flash('更新文章分类成功')->success();
            return redirect()->route('dashboard.article-categories.index');
        } else {
            flash('更新文章分类成功')->error();
            return back()->withInput();
        }
    }
}
