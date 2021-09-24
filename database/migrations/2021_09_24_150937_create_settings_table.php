<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->string('key')->unique()->comment('键');
            $table->text('value')->nullable()->comment('值');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });

        $this->initialData();
    }

    /**
     * 初始化数据
     */
    protected function initialData() {
        $data = [
            [
                'name'  =>  '关于社区 标题',
                'key'   =>  'wxapp_about_title',
                'value' =>  'HEY社区',
            ],
            [
                'name'  =>  '关于社区 子标题',
                'key'   =>  'wxapp_about_subtitle',
                'value' =>  'HeyCommunity',
            ],
            [
                'name'  =>  '关于社区 内容',
                'key'   =>  'wxapp_about_content',
                'value' =>  '<p>HEY社区（HeyCommunity）是一个社交软件项目（微信小程序）。当前产品功能以（图文、视频）动态分享为核心，支持点赞、评论、回复。同时也支持小程序订阅消息推送。<br></p><p>将来版本迭代会增加活动、话题、小组、IM&nbsp;等功能，将来也会开发&nbsp;APP&nbsp;和网页端。<br></p><p><br></p><p style="text-align: center;">电子邮箱: supgeek.rod@gmail.com<br>官方网站: <a href="http://www.heycommunity.com">www.heycommunity.com</a><br>GitHub 仓库: github.com/HeyCommunity<br></p><p style="text-align: center;"><br></p><p style="text-align: center;">©2021 ProtobiaTech<br></p>',
            ],

            [
                'name'  =>  '首页跑马灯 开关',
                'key'   =>  'wxapp_index_page_marquee_enable',
                'value' =>  true,
            ],
            [
                'name'  =>  '首页跑马灯 文本',
                'key'   =>  'wxapp_index_page_marquee_text',
                'value' =>  '这是「HEY社区」的产品演示，你可以在这里自由地分享有意义或有趣的内容 ~',
            ],
            [
                'name'  =>  '首页跑马灯 链接',
                'key'   =>  'wxapp_index_page_marquee_url',
                'value' =>  '/pages/systems/about/index',
            ],
        ];

        foreach ($data as $item) {
            $setting = new \App\Models\Setting();
            $setting->create($item);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
