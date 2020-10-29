<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

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

        App::setLocale('id');

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
        //
    }
}