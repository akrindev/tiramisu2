<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && $request->user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/')->with('gagal', 'Tidak punya akses');
    }
}
