<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/audit.php'));

            Route::middleware(['web', 'admin'])
                ->prefix('admin')
                ->namespace('App\Http\Controllers')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\RedirectIfNotAdmin::class,
            'locale' => \App\Http\Middleware\Locale::class,
            'force.json' => \App\Http\Middleware\ForceJsonResponse::class,
        ]);

        $middleware->appendToGroup('web', [
            \App\Http\Middleware\CheckUserPermission::class,
        ]);

        $middleware->appendToGroup('api', [
            \App\Http\Middleware\ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
