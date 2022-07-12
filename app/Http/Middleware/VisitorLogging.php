<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $logData = [
            'type'              =>  $this->getType($request),
            'route_name'        =>  $request->route()->getName(),

            'request_path'      =>  $request->path(),
            'request_uri'       =>  $request->server('REQUEST_URI'),
            'request_url'       =>  $request->url(),

            'visitor_ip'        =>  $request->ip(),
            'visitor_terminal'  =>  null,       // TODO 用户终端，如 safari / chrome / wxapp ..

            'http_host'         =>  $request->server('HTTP_HOST'),
            'http_user_agent'   =>  $request->server('HTTP_USER_AGENT'),

            'request_get_data'  =>  $request->query(),
            'request_post_data' =>  $request->post(),
            'request_cookies'   =>  null,
            'request_headers'   =>  null,
        ];

        $user = Auth::guard('sanctum')->user();
        if ($user) $logData['user_id'] = $user->id();

        VisitorLog::create($logData);

        return $response;
    }

    // TODO: 如 API / WEB / DASHBOARD ..
    protected function getType(Request $request)
    {
        if ($request->routeIs('dashboard.*')) return 'dashboard';
        if ($request->routeIs('api.*')) return 'api';
        if ($request->routeIs('web.*')) return 'web';

        return null;
    }
}
