<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        $locale = Str::contains(request()->getHttpHost(), 'en') ? 'en' : 'id';

        App::setLocale($locale);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
