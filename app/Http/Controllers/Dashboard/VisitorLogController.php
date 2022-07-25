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
                'id', 'user_id', 'response_status_code',
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
        $request->validate([
            'date'      =>  'date_format:Y-m-d',
        ]);

        // 如果没有指定 date，则把 date 指定为当天
        if (! $request->has('date')) {
            return redirect()->route($request->route()->getName(), ['date' => date('Y-m-d')]);
        }

        $result = VisitorLog::activeUserOfDate($request->get('date'))
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
