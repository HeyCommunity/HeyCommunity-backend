<?php

namespace Modules\Post\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        return view('post::dashboard.index', compact('posts'));
    }

    /**
     * 详情页
     */
    public function show(Post $post)
    {
        return view('post::dashboard.show', compact('post'));
    }

    /**
     * 上架处理
     */
    public function setVisible(Post $post)
    {
        $post->update(['status' => 1]);

        flash('动态上架成功')->success();
        return back();
    }


    /**
     * 下架处理
     */
    public function setHidden(Post $post)
    {
        $post->update(['status' => 2]);

        flash('动态下架成功')->success();
        return back();
    }

    /**
     * 删除处理
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash('动态删除成功')->success();
        return back();
    }
}
