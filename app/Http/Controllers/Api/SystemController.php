<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Settings.
     */
    public function settings()
    {
        return [
            'data' => [
                // 微信订阅消息
                'wxapp_subscribe_message'  =>  [
                    'enable'                =>  config('system.wxapp.subscribe_message.enable'),
                    'thumb_up_temp_id'      =>  config('system.wxapp.subscribe_message.thumb_up_temp_id'),
                    'comment_temp_id'       =>  config('system.wxapp.subscribe_message.comment_temp_id'),
                    'reply_temp_id'         =>  config('system.wxapp.subscribe_message.reply_temp_id'),
                ],

                // 首页跑马灯
                'wxapp_index_page_marquee'  =>  [
                    'enable'        =>  getSettingValueByKey('wxapp_index_page_marquee_enable', false),
                    'text'          =>  getSettingValueByKey('wxapp_index_page_marquee_text', null),
                    'url'           =>  getSettingValueByKey('wxapp_index_page_marquee_url', null),
                ],
            ],
        ];
    }

    /**
     * 关于社区.
     */
    public function about()
    {
        return [
            'data' => [
                'title'         =>  getSettingValueByKey('wxapp_about_title'),
                'subtitle'      =>  getSettingValueByKey('wxapp_about_subtitle'),
                'content'       =>  getSettingValueByKey('wxapp_about_content'),
            ],
        ];
    }

    /**
     * 社区准则.
     */
    public function regulation()
    {
        return [
            'data' => [
                'title'         =>  getSettingValueByKey('wxapp_regulation_title'),
                'content'       =>  getSettingValueByKey('wxapp_regulation_content'),
            ],
        ];
    }
}
