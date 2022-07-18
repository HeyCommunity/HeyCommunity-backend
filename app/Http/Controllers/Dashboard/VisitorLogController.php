<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorLogController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $visitorLogs = VisitorLog::query()
            ->select([
                'id', 'user_id',
                'route_name', 'request_method', 'request_uri',
                'visitor_ip_locale', 'visitor_ip', 'visitor_agent_device',
                'created_at',
            ])
            ->with([
                'user'  =>  function ($query) {
                    $query->select('id', 'avatar', 'nickname');
                },
            ])
            ->latest()
            ->paginate();

        return view('dashboard.visitor-logs.index', compact('visitorLogs'));
    }

    /**
     * 按日期显示日志
     */
    public function date(Request $request)
    {
        \Illuminate\Support\Facades\Validator::make($request->all(), [
            'date'      =>  'date_format:Y-m-d',
        ])->validate();

        if (! $request->has('date')) return redirect()->route($request->route()->getName(), ['date' => date('Y-m-d')]);

        $result = VisitorLog::query()
            ->select([
                'user_id',
                DB::raw('COUNT(*) as total_num'),
                DB::raw('MIN(created_at) as start_time'),
                DB::raw('MAX(created_at) as end_time'),
                DB::raw('GROUP_CONCAT(DISTINCT visitor_ip_locale) as locales'),
                DB::raw('GROUP_CONCAT(DISTINCT visitor_agent_device) as devices'),
            ])
            ->with(['someUserLogs' => function ($query) use ($request) {
                $query->whereDate('created_at', $request->get('date'));
            }])
            ->whereNotNull('user_id')
            ->whereDate('created_at', $request->get('date'))
            ->groupBy('user_id')
            ->paginate()
            ->appends(['date' => $request->get('date')]);

        return view('dashboard.visitor-logs.date', compact('result'));
    }

    /**
     * 分析页面
     */
    public function analytics()
    {
        return view('dashboard.visitor-logs.analytics');
    }
}
