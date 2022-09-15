<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        view()->share('pageTitle', config('post.name'));
    }
}
