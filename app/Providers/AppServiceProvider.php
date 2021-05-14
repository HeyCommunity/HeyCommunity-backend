<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TeleScope just only for local
        // if ($this->app->isLocal()) $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);           // TeleScope for all
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
