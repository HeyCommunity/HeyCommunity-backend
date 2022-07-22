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

        $startDate = now()->subDays(31);
        $endDate = now();

        $mainLineChartConfigure = AnalyticsBase::makeLineChartConfigure($startDate, $endDate, [
            ['name' => '用户增长', 'class' => User::class, 'color' => '#2c7be5'],
            [ 'name' => '用户活跃', 'class' => VisitorLog::class,
                'color' => '#2a9d8f', 'count_column' => 'DISTINCT user_id'],
            ['name' => '动态增长', 'class' => Post::class, 'color' => '#ffb703'],
            ['name' => '动态活跃', 'class' => Post::class, 'color' => '#f77f00', 'date_column' => 'updated_at'],
        ]);

        $thumbAndCommentLineChartConfigure = AnalyticsBase::makeLineChartConfigure($startDate, $endDate, [
            ['name' => '点赞', 'class' => Thumb::class, 'color' => '#6e84a3'],
            ['name' => '评论', 'class' => Comment::class, 'color' => '#39afd1'],
        ]);

        return view('dashboard.home.index', compact(
            'totalUserNum',
            'totalPostNum',
            'totalCommentNum',
            'totalThumbUpNum',
            'mainLineChartConfigure',
            'thumbAndCommentLineChartConfigure',
        ));
    }

    public function starTrack()
    {
        return view('dashboard.home.star-track');
    }
}
