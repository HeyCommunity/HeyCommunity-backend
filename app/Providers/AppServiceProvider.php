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
        if (config('telescope.enabled')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
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
            return $validator->validateRegex($attribute, $value, ['/^1[3456789]\d{9}$/']);
        }, '手机号码格式不正确');
    }
}
