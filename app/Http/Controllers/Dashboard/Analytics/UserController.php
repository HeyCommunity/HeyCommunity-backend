<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

        $chartData = [
            'labels'    =>  $labels,
            'datasets'  =>  [[
                'label' =>  '活跃',
                'data'  =>  $this->serializeData($dateList, $userCreateData),
            ]]
        ];

        return view('dashboard.analytics.users.index', compact('chartData'));
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
