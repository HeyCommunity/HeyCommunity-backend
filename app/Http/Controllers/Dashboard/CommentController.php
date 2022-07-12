<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Common\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with([
            'user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
            'parent' => function ($query) {
                $query->select('id', 'user_id');
            },
            'parent.user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
        ])->latest()->paginate();

        return view('dashboard.comments.index', compact('comments'));
    }
}
