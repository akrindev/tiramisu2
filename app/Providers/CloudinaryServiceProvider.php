<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Cloudinary as Cloud;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cloudinary', function () {
			return new Cloud();
		});
    }
}