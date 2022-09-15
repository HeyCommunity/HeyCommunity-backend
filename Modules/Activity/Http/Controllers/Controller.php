<?php

namespace Modules\Activity\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        view()->share('pageTitle', config('activity.name'));
    }
}
