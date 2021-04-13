<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WxAppController extends Controller
{
    /**
     * Settings
     */
    public function settings()
    {
        return response()->json([
            'data'  =>  [
                'appName'       =>  'HEY社区',
                'postAudit'     =>  env('WXAPP_SETTINGS_POST_AUDIT', true),
            ]
        ]);
    }
}
