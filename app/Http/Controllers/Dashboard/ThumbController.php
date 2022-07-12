<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Common\Thumb;
use Illuminate\Http\Request;

class ThumbController extends Controller
{
    public function index()
    {
        $thumbs = Thumb::with([
            'user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
            'thumbable' => function ($query) {
                $query->select('id', 'user_id');
            },
            'thumbable.user' => function ($query) {
                $query->select('id', 'avatar', 'nickname');
            },
        ])->latest()->paginate();

        return view('dashboard.thumbs.index', compact('thumbs'));
    }
}
