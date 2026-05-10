<?php

use App\Http\Middleware\CheckUserPermission;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\Locale;
use App\Http\Middleware\RedirectIfNotAdmin;
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
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => RedirectIfNotAdmin::class,
            'locale' => Locale::class,
            'force.json' => ForceJsonResponse::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'quiz/buat',
            'admin/change-user',
            'admin/taghapus',
            'forum/likereply',
            'send-token/fcm',
        ]);

        $middleware->appendToGroup('web', [
            CheckUserPermission::class,
        ]);

        $middleware->appendToGroup('api', [
            ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
