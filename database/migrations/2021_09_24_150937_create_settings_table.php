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
                'value' =>  '又一个新社区',
            ],
            [
                'name'  =>  '关于社区 内容',
                'key'   =>  'wxapp_about_content',
                'value' =>  '如你所见，我们基于开源的「HEY社区」产品构建了当前呈现的小程序。在遵守社区规章准则的同时，欢迎你在这里与我们一起，自由地分享有意义或有趣的事物 ~</p>',
            ],

            [
                'name'  =>  '社区准则 标题',
                'key'   =>  'wxapp_regulation_title',
                'value' =>  '社区准则',
            ],
            [
                'name'  =>  '社区准则 内容',
                'key'   =>  'wxapp_regulation_content',
                'value' =>  '用户可在平台自由发布有价值有意义的内容。但不得制作、上载、复制、发布、传播或者转载如下内容：<br>
                            <p style="margin-top:6px;">
                                1. 反对宪法所确定的基本原则的；<br>
                                2. 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；<br>
                                3. 损害国家荣誉和利益的；<br>
                                4. 煽动民族仇恨、民族歧视，破坏民族团结的；<br>
                                5. 侮辱、滥用英烈形象，否定英烈事迹，美化粉饰侵略战争行为的；<br>
                                6. 破坏国家宗教政策，宣扬邪教和封建迷信的；<br>
                                7. 散布谣言，扰乱社会秩序，破坏社会稳定的；<br>
                                8. 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；<br>
                                9. 侮辱或者诽谤他人，侵害他人合法权益的；<br>
                                10. 含有法律、行政法规禁止的其他内容的信息。
                            </p>
                ',
            ],

            [
                'name'  =>  '首页跑马灯 开关',
                'key'   =>  'wxapp_index_page_marquee_enable',
                'value' =>  true,
            ],
            [
                'name'  =>  '首页跑马灯 文本',
                'key'   =>  'wxapp_index_page_marquee_text',
                'value' =>  '欢迎你来到这里，与我们一起自由地分享有意义或有趣的事物 ~',
            ],
            [
                'name'  =>  '首页跑马灯 链接',
                'key'   =>  'wxapp_index_page_marquee_url',
                'value' =>  '/modules/system/pages/about/index',
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
