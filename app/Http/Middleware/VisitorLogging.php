<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        // dashboard not logging
        if ($request->routeIs('dashboard.*')) return $response;

        $logData = [
            'type'              =>  $this->getType($request),
            'route_name'        =>  $request->route() ? $request->route()->getName() : null,

            'request_path'      =>  $request->path(),
            'request_uri'       =>  Str::limit($request->server('REQUEST_URI'), 990),
            'request_url'       =>  Str::limit($request->url(), 990),

            'visitor_ip'        =>  $request->ip(),
            'visitor_terminal'  =>  $this->getVisitorTerminal($request),

            'http_host'         =>  $request->server('HTTP_HOST'),
            'http_user_agent'   =>  $request->server('HTTP_USER_AGENT'),

            'request_get_data'  =>  $request->query(),
            'request_post_data' =>  $request->post(),
            'request_cookies'   =>  null,
            'request_headers'   =>  null,
        ];

        $user = Auth::guard('sanctum')->user();
        if ($user) $logData['user_id'] = $user->id;

        VisitorLog::create($logData);

        return $response;
    }

    /**
     * getType
     *
     * @param Request $request
     * @return string|null
     */
    protected function getType(Request $request)
    {
        if ($request->is('api/*')) return 'api';
        if ($request->routeIs('web.*')) return 'web';
        if ($request->routeIs('dashboard.*')) return 'dashboard';

        return null;
    }



    /**
     * getVisitorTerminal
     * TODO: 用户终端，如 safari / chrome / wxapp ..
     *
     * @param Request $request
     * @return null
     */
    protected function getVisitorTerminal(Request $request)
    {
        return null;
    }
}
