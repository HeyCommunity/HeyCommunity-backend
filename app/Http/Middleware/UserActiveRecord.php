<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActiveRecord
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
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            $user->update([
                'last_active_at'    =>  now(),
            ]);
        }

        return $next($request);
    }
}
