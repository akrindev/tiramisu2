<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() &&
         auth()->user()->banned === 1) {
            auth()->logout();
        }

        return $next($request);
    }
}
