<?php

namespace Modules\Article\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Article\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::namespace($this->moduleNamespace . '\Api')
            ->middleware('api')
            ->group(module_path('Article', '/Routes/api.php'));

        Route::namespace($this->moduleNamespace . '\Web')
            ->middleware('web')
            ->group(module_path('Article', '/Routes/web.php'));

        Route::namespace($this->moduleNamespace . '\Dashboard')
            ->middleware(['web', 'auth.dashboard'])
            ->group(module_path('Article', '/Routes/dashboard.php'));
    }
}
