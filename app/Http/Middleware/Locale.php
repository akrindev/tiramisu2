<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $locale = 'id')
    {
        if($locale == 'en') {
            app()->setLocale('en');
        }

        return $next($request);
    }
}