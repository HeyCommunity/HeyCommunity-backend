<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use App\Models\VisitorLog;
use Modules\Post\Entities\Post;

class HomeController extends Controller
{
    public function index()
    {
        $totalUserNum = User::count();
        $totalPostNum = Post::count();
        $totalCommentNum = Comment::count();
        $totalThumbUpNum = Thumb::where('type', 'thumb_up')->count();

        $startDate = now()->subDays(26);
        $endDate = now();

        $mainLineChartConfigure = AnalyticsBase::makeLineChartConfigure($startDate, $endDate, [
            ['name' => '用户增长', 'class' => User::class, 'color' => '#2c7be5'],
            ['name' => '用户活跃', 'class' => VisitorLog::class, 'color' => '#2a9d8f', 'count_column' => 'DISTINCT user_id'],
            ['name' => '访客请求', 'class' => VisitorLog::class, 'hidden' => true],
            ['name' => '动态增长', 'class' => Post::class, 'color' => '#ffb703', 'hidden' => true],
            ['name' => '点赞数', 'class' => Thumb::class, 'color' => '#6e84a3', 'hidden' => true],
            ['name' => '评论数', 'class' => Comment::class, 'color' => '#39afd1', 'hidden' => true],
        ]);

        return view('dashboard.home.charts', compact(
            'totalUserNum',
            'totalPostNum',
            'totalCommentNum',
            'totalThumbUpNum',
            'mainLineChartConfigure',
        ));
    }
}
