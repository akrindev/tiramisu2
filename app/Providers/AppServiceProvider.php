<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use App;

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
		if (env('APP_ENV') === 'production')
        {
     		\URL::forceScheme('https');
        }

		$locale = Str::contains(request()->getHttpHost(), 'en') ? 'en' : 'id';

        App::setLocale($locale);

        Blade::directive('canonical', function($exp) {
        	return "<?php echo canonical()->toHtml(); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}