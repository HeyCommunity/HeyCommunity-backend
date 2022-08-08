<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LogViewerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? null;

        if (Str::contains($requestUri, 'dashboard/laravel-log-viewer')) {
            config()->set('log-viewer.route.enabled', true);
            config()->set('log-viewer.route.attributes.prefix', 'dashboard/laravel-log-viewer');
            config()->set('log-viewer.storage-path', storage_path('logs'));
            config()->set('log-viewer.pattern.prefix', 'laravel-');

            $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);
            $this->app->register(\Arcanedev\LogViewer\Providers\DeferredServicesProvider::class);
        } elseif (Str::contains($requestUri, 'dashboard/heycommunity-log-viewer')) {
            config()->set('log-viewer.route.enabled', true);
            config()->set('log-viewer.route.attributes.prefix', 'dashboard/heycommunity-log-viewer');
            config()->set('log-viewer.storage-path', storage_path('logs/heycommunity'));
            config()->set('log-viewer.pattern.prefix', 'hc-');

            $this->app->register(\Arcanedev\LogViewer\LogViewerServiceProvider::class);
            $this->app->register(\Arcanedev\LogViewer\Providers\DeferredServicesProvider::class);
        }
    }
}
