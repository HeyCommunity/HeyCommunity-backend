<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpBasicAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authUser = 'heycommunity';
        $authPassword = 'please-change-this-password';              // TODO: 请修改这个密码

        if ($request->getUser() !== $authUser || $request->getPassword() !== $authPassword) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
