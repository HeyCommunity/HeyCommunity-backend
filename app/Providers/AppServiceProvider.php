<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        // Telescope and LogViewer for Ops debugging. You can turn it off if you don't need it
        if ('just-register-for-ops-debugging' || $this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);
            $this->app->register(\Arcanedev\LogViewer\Providers\DeferredServicesProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 使用 bootstrap 风格的分页
        \Illuminate\Pagination\Paginator::useBootstrap();

        // 中国手机号码验证器
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return $validator->validateRegex($attribute, $value, ['/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/']);
        });
    }
}
