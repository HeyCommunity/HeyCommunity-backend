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
                'value' =>  'todo content',
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
                'value' =>  '/pages/heycommunity/about/index',
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
