<?php

namespace Modules\Article\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Entities\ArticleTag;

class ArticleTagController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $articleTags = ArticleTag::paginate();

        return view('article::dashboard.article-tags.index', compact('articleTags'));
    }

    /**
     * 创建页
     */
    public function create()
    {
        $articleTag = new ArticleTag();

        return view('article::dashboard.article-tags.create', compact('articleTag'));
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

        $articleTag = ArticleTag::create([
            'slug'          =>  $request->get('slug'),
            'name'          =>  $request->get('name'),
            'description'   =>  $request->get('description'),
        ]);

        if ($articleTag) {
            flash('创建文章标签成功')->success();
            return redirect()->route('dashboard.article-tags.index');
        } else {
            flash('创建文章标签成功')->error();
            return back()->withInput();
        }
    }

    /**
     * 编辑页
     */
    public function edit(ArticleTag $articleTag)
    {
        return view('article::dashboard.article-tags.edit', compact('articleTag'));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, ArticleTag $articleTag)
    {
        $request->validate([
            'slug'          =>  'required|string',
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
        ]);

        $articleTag->setAttribute('slug', $request->get('slug'));
        $articleTag->setAttribute('name', $request->get('name'));
        $articleTag->setAttribute('description', $request->get('description'));

        if ($articleTag->save()) {
            flash('更新文章标签成功')->success();
            return redirect()->route('dashboard.article-tags.index');
        } else {
            flash('更新文章标签成功')->error();
            return back()->withInput();
        }
    }
}
