<?php

namespace Modules\Article\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        view()->share('moduleName', config('article.name'));
    }
}
