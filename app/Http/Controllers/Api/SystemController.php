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
            'data' => [
                // 用户生产内容 审核
                'ugc_audit'     =>  config('system.ugc_audit'),

                // 微信订阅消息
                'wxapp_subscribe_message'  =>  [
                    'enable'                =>  config('system.wxapp.subscribe_message.enable'),
                    'thumb_up_temp_id'      =>  config('system.wxapp.subscribe_message.thumb_up_temp_id'),
                    'comment_temp_id'       =>  config('system.wxapp.subscribe_message.comment_temp_id'),
                    'reply_temp_id'         =>  config('system.wxapp.subscribe_message.reply_temp_id'),
                ],
            ]
        ];
    }
}
