<?php

namespace App\Providers;

use App\Helpers\CommonUtils;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('utils.common', CommonUtils::class);
    }
}
