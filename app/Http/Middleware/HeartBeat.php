<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HeartBeat
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
        $data = [
            'app_env'       =>  config('app.env'),
            'app_name'      =>  config('app.name'),
            'app_url'       =>  config('app.url'),
            'domain'        =>  $_SERVER['HTTP_HOST'] ?? NULL,
            'datetime'      =>  date('Y-m-d H:i:s'),
        ];

        $this->httpRequest($data);

        return $next($request);
    }

    public function httpRequest($data)
    {
        $cacheKey = 'HeyCommunity-HeartBeat';
        $cacheExpire = now()->addHour();

        $requestUri = 'https://www.heycommunity.com/heart-beat-server';

        if (Cache::get($cacheKey) === null) {
            try{
                Cache::put($cacheKey, $data, $cacheExpire);

                $client = new Client();
                $promise = $client->getAsync($requestUri, [
                    'timeout'       =>  '1',
                    'query'   =>  $data
                ]);

                $promise->wait();
            } catch (Exception $exception) {
            }
        }
    }
}
