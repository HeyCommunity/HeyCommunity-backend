<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAuthenticate
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
        if (Auth::guard('web')->check()
            && in_array(Auth::guard('web')->id(), config('heycommunity.dashboard.admin_ids'))) {

            return $next($request);
        }

        return redirect()->route('dashboard.auth.login');
    }
}
