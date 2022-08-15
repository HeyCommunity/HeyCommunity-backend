<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsBase;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;
use Modules\Post\Entities\Post;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.home.index', [
            'modelTrendData'            =>  $this->getModelTrendData(),
            'mainChartConfigure'        =>  $this->getMainChartConfigure(),
            'userWeekActiveConfigure'   =>  $this->getUserWeekActiveChartConfigure(),
            'visitorLogChartConfigure'  =>  $this->getVisitorLogChartConfigure(),
        ]);
    }

    protected function getModelTrendData()
    {
        $weekStartDate = today()->subDays(6);
        $monthStartDate = today()->subMonth(1)->addDay();

        return [
            'user'  =>  [
                'total'         =>  User::count(),
                'week_num'      =>  User::whereDate('created_at', '>=', $weekStartDate)->count(),
                'month_num'     =>  User::whereDate('created_at', '>=', $monthStartDate)->count(),
            ],
            'post'  =>  [
                'total'         =>  Post::count(),
                'week_num'      =>  Post::whereDate('created_at', '>=', $weekStartDate)->count(),
                'month_num'     =>  Post::whereDate('created_at', '>=', $monthStartDate)->count(),
            ],
            'comment'  =>  [
                'total'         =>  Comment::count(),
                'week_num'      =>  Comment::whereDate('created_at', '>=', $weekStartDate)->count(),
                'month_num'     =>  Comment::whereDate('created_at', '>=', $monthStartDate)->count(),
            ],
            'thumb_up'  =>  [
                'total'         =>  Thumb::where('type', 'thumb_up')->count(),
                'week_num'      =>  Thumb::where('type', 'thumb_up')->whereDate('created_at', '>=', $weekStartDate)->count(),
                'month_num'     =>  Thumb::where('type', 'thumb_up')->whereDate('created_at', '>=', $monthStartDate)->count(),
            ],
        ];
    }

    protected function getMainChartConfigure()
    {
        $startDate = now()->subDays(27);
        $endDate = now();

        return AnalyticsBase::makeLineChartConfigure($startDate, $endDate, [
            ['name' => '用户活跃', 'class' => VisitorLog::class, 'color' => '#2a9d8f', 'count_column' => 'DISTINCT user_id'],
            ['name' => '用户增长', 'class' => User::class, 'color' => '#2c7be5'],
            ['name' => '访客请求', 'class' => VisitorLog::class, 'hidden' => true],
            ['name' => '动态增长', 'class' => Post::class, 'color' => '#ffb703', 'hidden' => true],
            ['name' => '点赞数', 'class' => Thumb::class, 'color' => '#6e84a3', 'hidden' => true],
            ['name' => '评论数', 'class' => Comment::class, 'color' => '#39afd1', 'hidden' => true],
        ]);
    }

    protected function getUserWeekActiveChartConfigure()
    {
        $labelList = [
            [
                'name'          =>  '本周',
                'start_date'    =>  now()->startOfWeek()->format('Y-m-d'),
                'end_date'      =>  now()->endOfWeek()->format('Y-m-d'),
            ],
        ];

        foreach (range(1, 11) as $item) {
            array_unshift($labelList, [
                'name'          =>  '前' . $item . '周',
                'start_date'    =>  now()->subWeeks($item)->startOfWeek()->format('Y-m-d'),
                'end_date'      =>  now()->subWeeks($item)->endOfWeek()->format('Y-m-d'),
            ]);
        }

        $labels = collect($labelList)->pluck('name')->toArray();

        $visitorLogs = VisitorLog::query()
            ->select([
                'user_id',
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
            ])
            ->groupBy('user_id', 'date')
            ->with('user', function ($query) {
                $query->select(['id', 'created_at']);
            })
            ->whereNotNull('user_id')
            ->whereDate('created_at', '>=', $labelList[0]['start_date'])
            ->get();

        $getDatasetDataFn = function ($onlyNewUser = false) use ($labelList, $visitorLogs) {
            foreach ($labelList as $label) {
                $query = $visitorLogs
                    ->where('date', '>=', $label['start_date'])
                    ->where('date', '<=', $label['end_date']);

                if ($onlyNewUser) {
                    $query = $query->where('user.created_at', '>=', $label['start_date'])
                        ->where('user.created_at', '<=', $label['end_date']);
                }

                $data[$label['name']] = $query->count();
            }

            return $data;
        };

        return [
            'type'  =>  'bar',
            'data'  =>  [
                'labels'    =>  $labels,
                'datasets'  =>  [
                    [
                        'label'             =>  '全部',
                        'data'              =>  $getDatasetDataFn(),
                    ],
                    [
                        'label'             =>  '新用户',
                        'data'              =>  $getDatasetDataFn(true),
                        'backgroundColor'   =>  '#d2ddec',
                        'hidden'            =>  'true'
                    ],
                ],
            ],
        ];
    }

    protected function getVisitorLogChartConfigure()
    {
        $startDate = now()->subMonth()->subDay();

        $visitorLogTotal = VisitorLog::whereDate('created_at', '>=', $startDate)->count();
        $wxappVisitorLogTotal = VisitorLog::whereDate('created_at', '>=', $startDate)->where('request_path', 'like', 'api/%')->count();
        $webVisitorLogTotal = VisitorLog::whereDate('created_at', '>=', $startDate)->where('route_name', 'like', 'web.%')->count();
        $otherVisitorLogTotal = $visitorLogTotal - $wxappVisitorLogTotal - $webVisitorLogTotal;

        $userVisitorLogTotal = VisitorLog::whereNotNull('user_id')->whereDate('created_at', '>=', $startDate)->count();
        $userWxappVisitorLogTotal = VisitorLog::whereNotNull('user_id')->whereDate('created_at', '>=', $startDate)->where('request_path', 'like', 'api/%')->count();
        $userWebVisitorLogTotal = VisitorLog::whereNotNull('user_id')->whereDate('created_at', '>=', $startDate)->where('route_name', 'like', 'web.%')->count();
        $userOtherVisitorLogTotal = $userVisitorLogTotal - $userWxappVisitorLogTotal - $userWebVisitorLogTotal;

        return [
            'type'  =>  'doughnut',
            'data'  =>  [
                'labels'    =>  ['小程序', '网站', '其他'],
                'datasets'  =>  [
                    [
                        'data'              =>  [$wxappVisitorLogTotal, $webVisitorLogTotal, $otherVisitorLogTotal],
                        'backgroundColor'   =>  ['#2C7BE5', '#A6C5F7', '#D2DDEC'],
                    ],
                    [
                        'data'              =>  [$userWxappVisitorLogTotal, $userWebVisitorLogTotal, $userOtherVisitorLogTotal],
                        'backgroundColor'   =>  ['#2C7BE5', '#A6C5F7', '#D2DDEC'],
                        'hidden'            =>  'true'
                    ],
                ],
            ],
        ];
    }
}
