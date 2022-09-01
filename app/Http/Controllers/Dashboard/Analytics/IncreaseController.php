<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;

class IncreaseController extends Controller
{
    public function index(Request $request)
    {
        $userIncreaseData = User::whereDate('created_at', '>=', today()->subDays(6))->latest()->get();
        $userActiveData = User::whereDate('last_active_at', '>=', today()->subDays(6))->orderByDesc('last_active_at')->get();
        $postIncreaseData = Post::whereDate('created_at', '>=', today()->subDays(6))->latest()->get();
        $commentIncreaseData = Comment::whereDate('created_at', '>=', today()->subDays(6))->latest()->get();
        $thumbUpIncreaseData = Thumb::where('type', 'thumb_up')->whereDate('created_at', '>=', today()->subDays(6))->latest()->get();

        return view('dashboard.analytics.increases.index', compact(
            'userIncreaseData',
            'userActiveData',
            'postIncreaseData',
            'commentIncreaseData',
            'thumbUpIncreaseData',
        ));
    }
}
