<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Settings
     */
    public function settings()
    {
        return [
            'ugc_audit'     =>  config('system.ugc_audit'),
        ];
    }
}
