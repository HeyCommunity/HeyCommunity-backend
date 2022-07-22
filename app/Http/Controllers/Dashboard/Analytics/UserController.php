<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\User;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $startDate = now()->subDays(30);
        $endDate = now();

        // 用户图表配置
        $userChartConfigure = AnalyticsBase::makeChartConfigure($startDate, $endDate, [
            User::class => ['name' => '用户增长', 'color' => '#264653'],
            VisitorLog::class => [
                'name'          => '活跃活跃',
                'color'         => '#2a9d8f',
                'count_column'  =>  'DISTINCT user_id',
            ],
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

        return view('dashboard.analytics.users.index', compact('userChartConfigure', 'user7DaysActiveData'));
    }

    protected function serializeData($dateList, $data)
    {
        $result = [];
        foreach ($dateList as $index => $date) {
            $result[$date] = $data[$date] ?? 0;
        }

        return array_values($result);
    }
}
