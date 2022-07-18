<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Post\Entities\Post;

class HomeController extends Controller
{
    public function index()
    {
        $totalUserNum = User::count();
        $totalPostNum = Post::count();
        $totalCommentNum = Comment::count();
        $totalThumbUpNum = Thumb::where('type', 'thumb_up')->count();

        $startDate = now()->subDays(30);
        $endDate = now();

        $userChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [User::class => ['name' => '增长']]);
        $contentChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [
            Post::class => ['name' => '动态', 'color' => '#39afd1'],
        ]);
        $commonChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [
            Comment::class => ['name' => '评论', 'color' => '#39afd1'],
            Thumb::class => ['name' => '点赞', 'color' => '#6e84a3'],
        ]);

        return view('dashboard.home.index', compact(
            'totalUserNum', 'totalPostNum', 'totalCommentNum', 'totalThumbUpNum',
            'userChartConfigure', 'contentChartConfigure', 'commonChartConfigure',
        ));
    }

    public function starTrack()
    {
        return view('dashboard.home.star-track');
    }
}
