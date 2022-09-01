<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Exception;
use GeoIp2\Database\Reader as GeoIp2Render;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Laravel\Sanctum\PersonalAccessToken;

class VisitorLogging
{
    /**
     * 忽略的路径
     *
     * @var array|string[]
     */
    protected array $ignorePaths = [
        'dashboard*',
        '_debugbar*',
        '__clockwork*', 'clockwork*',
    ];

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

        $visitorIpInfo = $this->getIpInfo($request->ip());      // IP 信息
        $visitorAgentInfo = $this->getAgentInfo();              // 设备信息

        // dashboard not logging
        if (! $request->is($this->ignorePaths)) {
            $logData = [
                'route_type'        =>  $this->getRouteType($request),
                'route_name'        =>  $request->route() ? $request->route()->getName() : null,

                'response_status_code'  =>  $response->getStatusCode(),
                'request_method'        =>  $request->method(),
                'request_path'          =>  Str::limit($request->path(), 255, null),
                'request_uri'           =>  Str::limit($request->server('REQUEST_URI'), 255, null),
                'request_url'           =>  Str::limit($request->fullUrl(), 255, null),
                'request_domain'        =>  $request->getHttpHost(),
                'referer_url'           =>  Str::limit($request->server('HTTP_REFERER'), 255, null),

                'visitor_ip'            =>  $request->ip(),
                'visitor_ip_locale'     =>  $visitorIpInfo['city'] ?? 'UNKNOWN',
                'visitor_ip_info'       =>  $visitorIpInfo,
                'visitor_agent_device'          =>  $visitorAgentInfo['device'],
                'visitor_agent_device_type'     =>  $visitorAgentInfo['device_type'],
                'visitor_agent_info'            =>  $visitorAgentInfo,

                'request_data'      =>  [
                    'get'       =>  $request->query(),
                    'post'      =>  $request->post(),
                    'server'    =>  $request->server->all(),
                    'cookies'   =>  $request->cookies->all(),
                    'headers'   =>  $request->headers->all(),
                ],
            ];

            // 记录 user_id
            $user = Auth::guard('sanctum')->user() ?: optional(PersonalAccessToken::findToken($request->header('TrackToken')))->tokenable;
            if ($user) {
                $logData['user_id'] = $user->getAttribute('id');
            }

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
        if ($request->is('/api*')) {
            return 'api';
        } elseif ($request->routeIs('web.*')) {
            return 'web';
        } elseif ($request->is('/dashboard*')) {
            return 'dashboard';
        }

        return null;
    }

    /**
     * 获取 IP 信息
     *
     * @param $ip
     * @return string[]
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    protected function getIpInfo($ip): array
    {
        $geoLite2CityFilePath = storage_path('MaxMind-GeoIP/GeoLite2-City.mmdb');

        if (file_exists($geoLite2CityFilePath)) {
            $geoReader = new GeoIp2Render($geoLite2CityFilePath, ['zh-CN', 'en']);

            try {
                $geoCityResult = $geoReader->city($ip);

                $ipInfo['country']  =   $geoCityResult->country->name;
                $ipInfo['province'] =   $geoCityResult->mostSpecificSubdivision->name;
                $ipInfo['city']     =   $geoCityResult->city->name;

                $ipInfo['country_iso_code']     =   $geoCityResult->country->isoCode;
                $ipInfo['province_iso_code']    =   $geoCityResult->mostSpecificSubdivision->isoCode;
            } catch (Exception $exception) {
            }
        }

        $ipInfo['ip'] = $ip;

        return $ipInfo;
    }

    /**
     * 获取设备信息
     *
     * @return array
     */
    protected function getAgentInfo(): array
    {
        $agent = new Agent();

        return [
            'languages'             =>  $agent->languages(),
            'platform'              =>  $agent->platform(),
            'platform_version'      =>  $agent->version($agent->platform()),
            'browser'               =>  $agent->browser(),
            'browser_version'       =>  $agent->version($agent->browser()),
            'device'                =>  $agent->device(),
            'device_type'           =>  $agent->deviceType(),
        ];
    }
}
