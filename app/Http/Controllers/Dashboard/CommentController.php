<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Common\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * 首页面
     */
    public function index()
    {
        $comments = Comment::with([
            'user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
            'parent' => function ($query) {
                $query->select('id', 'user_id', 'entity_class', 'entity_id');
            },
            'parent.user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
            'commentable' => function ($query) {
                $query->select('id', 'user_id');
            },
            'commentable.user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
        ])->latest()->paginate();

        return view('dashboard.comments.index', compact('comments'));
    }

    /**
     * 详情页面
     */
    public function show(Comment $comment)
    {
        $post = $comment->entity;

        return view('dashboard.comments.show', compact('comment', 'post'));
    }
}
