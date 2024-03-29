<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\User;
use App\Models\VisitorLog;

class UserController extends Controller
{
    public function index()
    {
        $startDate = now()->subDays(31);
        $endDate = now();

        // 用户图表配置
        $userLineChartConfigure = AnalyticsBase::makeLineChartConfigure($startDate, $endDate, [
            ['name' => '用户增长', 'class' => User::class, 'color' => '#2c7be5'],
            ['name' => '用户活跃', 'class' => VisitorLog::class,
                'color' => '#2a9d8f', 'count_column' => 'DISTINCT user_id'],
        ]);

        // 最近 7 天活跃用户，每页 100 用户
        $user7DaysActiveData = (function () {
            $result = [];

            foreach (range(0, 6) as $subDayNum) {
                $date = now()->subDays($subDayNum);
                $result[$date->format('Y-m-d')] = VisitorLog::activeUserOfDate($date)->paginate(100);
            }

            return $result;
        })();

        return view('dashboard.analytics.users.index', compact('userLineChartConfigure', 'user7DaysActiveData'));
    }
}
