<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use App\Models\VisitorLog;
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

        $mainChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [
            User::class => ['name' => '用户增长', 'color' => '#264653'],
            VisitorLog::class => [
                'name'          => '活跃活跃',
                'color'         => '#2a9d8f',
                'count_column'  =>  'DISTINCT user_id',
            ],
            Post::class => ['name' => '动态数', 'color' => '#ffb703'],
        ]);

        $thumbAndCommentChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [
            Thumb::class => ['name' => '点赞', 'color' => '#6e84a3'],
            Comment::class => ['name' => '评论', 'color' => '#39afd1'],
        ]);

        return view('dashboard.home.index', compact(
            'totalUserNum',
            'totalPostNum',
            'totalCommentNum',
            'totalThumbUpNum',
            'mainChartConfigure',
            'thumbAndCommentChartConfigure',
        ));
    }

    public function starTrack()
    {
        return view('dashboard.home.star-track');
    }
}
