<?php

namespace App\Providers;

use App\Helpers\Cloudinary as Cloud;
use Illuminate\Support\ServiceProvider;

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
