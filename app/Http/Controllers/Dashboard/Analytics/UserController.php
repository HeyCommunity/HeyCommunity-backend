<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $startDate = now()->subDays(30);
        $endDate = now();

        $labelDate = $startDate->clone();
        $dateList = [];
        $labels = [];
        do {
            $dateList[] = $labelDate->format('Y-m-d');
            $labels[] = $labelDate->format('n/j');
        } while ($labelDate->addDay() <= $endDate);

        // 用户新增数据
        $userCreateData = User::query()
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
            ])
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')->orderBy('date')
            ->get()
            ->pluck('count', 'date')->toArray();

        $userActiveData = VisitorLog::query()
            ->whereNotNull('user_id')
            ->select([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(DISTINCT user_id) as count'),
            ])
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')->orderBy('date')
            ->get()
            ->pluck('count', 'date')->toArray();


        $chartData = [
            'labels'    =>  $labels,
            'datasets'  =>  [[
                'label' =>  '新增',
                'data'  =>  $this->serializeData($dateList, $userCreateData),
            ], [
                'label' =>  '活跃',
                'data'  =>  $this->serializeData($dateList, $userActiveData),
                'borderColor' =>    '#39afd1',
            ]]
        ];


        // 最近 7 天活跃用户，每页 100 用户
        $user7DaysActiveData = (function () {
            $result = [];

            foreach (range(0, 6) as $subDayNum) {
                $date = now()->subDays($subDayNum);
                $result[$date->format('Y-m-d')] = VisitorLog::activeUserOfDate($date)->paginate(100);
            }

            return $result;
        })();

        return view('dashboard.analytics.users.index', compact('chartData', 'user7DaysActiveData'));
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
