<?php

namespace Modules\Article\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleTag;

class ArticleController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $articles = Article::latest()->paginate();

        return view('article::dashboard.articles.index', compact('articles'));
    }

    /**
     * 详情页
     */
    public function show(Article $article)
    {
        return view('article::dashboard.articles.show', compact('article'));
    }

    /**
     * 创建页
     */
    public function create()
    {
        $article = new Article();
        $categories = ArticleCategory::pluck('name', 'id')->toArray();
        $tags = ArticleTag::pluck('name', 'id')->toArray();

        $dropzoneConfig = json_encode([
            'url'           =>  route('dashboard.articles.store'),
            'maxFiles'      =>  1,
            'acceptedFiles'     => 'image/*',
            'thumbnailWidth'    =>  1200,
            'thumbnailHeight'   =>  600,
        ]);

        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('article::dashboard.articles.create', compact(
            'article',
            'categories',
            'tags',
            'dropzoneConfig',
            'quillEditorConfig'
        ));
    }

    /**
     * 创建处理
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover'             =>  'required|image',
            'title'             =>  'required|string',
            'author'            =>  'required|string',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
            'categories'        =>  'required|array',
            'tags'              =>  'nullable|array',
            'status'            =>  'required|integer',
            'published_at'      =>  'required|date',
        ]);

        DB::beginTransaction();
        try {
            $coverPath = $request->cover->store('uploads/articles/covers');

            $article = Article::create([
                'user_id'           =>  $request->user()->id,
                'cover'             =>  $coverPath,
                'title'             =>  $request->get('title'),
                'author'            =>  $request->get('author'),
                'intro'             =>  $request->get('intro'),
                'content'           =>  $request->get('content'),
                'status'            =>  $request->get('status'),
                'published_at'      =>  $request->get('published_at'),
            ]);

            $article->categories()->sync($request->get('categories'));
            $article->tags()->sync($request->get('tags'));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            flash('创建文章失败')->error();
            return redirect()->back()->withInput();
        }

        flash('创建文章成功')->success();
        return redirect()->route('dashboard.articles.index');
    }

    /**
     * 编辑页面
     */
    public function edit(Article $article)
    {
        $categories = ArticleCategory::pluck('name', 'id')->toArray();
        $tags = ArticleTag::pluck('name', 'id')->toArray();

        $dropzoneConfig = json_encode([
            'url'           =>  route('dashboard.articles.store'),
            'maxFiles'      =>  1,
            'acceptedFiles'     => 'image/*',
            'thumbnailWidth'    =>  1200,
            'thumbnailHeight'   =>  600,
        ]);

        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('article::dashboard.articles.edit', compact(
            'article',
            'categories',
            'tags',
            'dropzoneConfig',
            'quillEditorConfig'
        ));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'cover'             =>  'nullable|image',
            'title'             =>  'required|string',
            'author'            =>  'required|string',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
            'categories'        =>  'required|array',
            'tags'              =>  'nullable|array',
            'status'            =>  'required|integer',
            'published_at'      =>  'required|date',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'title'             =>  $request->get('title'),
                'author'            =>  $request->get('author'),
                'intro'             =>  $request->get('intro'),
                'content'           =>  $request->get('content'),
                'status'            =>  $request->get('status'),
                'published_at'      =>  $request->get('published_at'),
            ];

            if ($request->has('cover')) {
                $coverPath = $request->cover->store('uploads/articles/covers');
                $data['cover'] = $coverPath;
            }

            $article->update($data);

            $article->categories()->sync($request->get('categories'));
            $article->tags()->sync($request->get('tags'));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            flash('更新文章失败')->error();
            return redirect()->back()->withInput();
        }


        flash('更新文章成功')->success();
        return redirect()->route('dashboard.articles.index');
    }
}
