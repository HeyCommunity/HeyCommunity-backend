<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use itbdw\Ip\IpLocation;
use Jenssegers\Agent\Agent;

class VisitorLogging
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // dashboard not logging
        if (! $request->is([
            '_debugbar*',
            'dashboard*',
        ])) {
            $logData = [
                'route_type'        =>  $this->getRouteType($request),
                'route_name'        =>  $request->route() ? $request->route()->getName() : null,

                'request_method'    =>  $request->method(),
                'request_path'      =>  Str::limit($request->path(), 255, null),
                'request_uri'       =>  Str::limit($request->server('REQUEST_URI'), 255, null),
                'request_url'       =>  Str::limit($request->fullUrl(), 255, null),
                'request_domain'    =>  $request->getHttpHost(),
                'referer_url'       =>  Str::limit($request->server('HTTP_REFERER'), 255, null),

                'visitor_ip'            =>  $request->ip(),
                'visitor_ip_locale'     =>  $this->getIpInfo($request->ip(), 'locale'),
                'visitor_ip_info'       =>  $this->getIpInfo($request->ip()),
                'visitor_agent_device'          =>  $this->getAgentInfo('device'),
                'visitor_agent_device_type'     =>  $this->getAgentInfo('deviceType'),
                'visitor_agent_info'            =>  $this->getAgentInfo(),

                'request_data'      =>  [
                    'get'       =>  $request->query(),
                    'post'      =>  $request->post(),
                    'server'    =>  $request->server->all(),
                    'cookies'   =>  $request->cookies->all(),
                    'headers'   =>  $request->headers->all(),
                ],
            ];

            // 记录 user_id
            $user = Auth::guard('sanctum')->user();
            if ($user) $logData['user_id'] = $user->getAttribute('id');

            VisitorLog::create($logData);
        }

        return $response;
    }

    /**
     * getRouteType
     *
     * @param Request $request
     * @return string|null
     */
    protected function getRouteType(Request $request): ?string
    {
        if ($request->is('/api*')) return 'api';
        if ($request->routeIs('web.*')) return 'web';
        if ($request->is('/dashboard*')) return 'dashboard';

        return null;
    }

    /**
     * @param $ip
     * @param null $item
     * @return array|mixed|string|string[]
     * @throws Exception
     */
    protected function getIpInfo($ip, $item = null)
    {
        $ipInfo = IpLocation::getLocation($ip);

        if (isset($item)) {
            switch ($item) {
                case 'locale':
                    return $ipInfo['city'] ?: ($ipInfo['province'] ?: $ipInfo['country']);
                default:
                    throw new Exception('The item of getIpInfo is illegal');
            }
        }

        return $ipInfo;
    }

    /**
     * @param null $item
     * @return array|bool|string|null
     * @throws Exception
     */
    protected function getAgentInfo($item = null)
    {
        $agent = new Agent();

        if (isset($item)) {
            switch ($item) {
                case 'device':
                    return $agent->device();
                case 'deviceType':
                    if ($agent->isDesktop()) return 'desktop';
                    if ($agent->isTablet()) return 'tablet';
                    if ($agent->isPhone()) return 'phone';
                    return null;
                default:
                    throw new Exception('The item of getAgentInfo is illegal');
            }
        }

        return [
            'languages'             =>  $agent->languages(),
            'platform'              =>  $agent->platform(),
            'platform_version'      =>  $agent->version($agent->platform()),
            'browser'               =>  $agent->browser(),
            'browser_version'       =>  $agent->version($agent->browser()),
            'device'                =>  $agent->device(),
        ];
    }
}
