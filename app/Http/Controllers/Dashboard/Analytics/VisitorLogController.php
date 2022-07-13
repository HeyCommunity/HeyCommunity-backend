<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;

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

        return view('dashboard.analytics.visitor-logs.index', compact('visitorLogs'));
    }
}
