<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sort')->nullable()->comment('排序');
            $table->string('type')->index()->comment('类型');

            $table->string('title')->comment('标题');
            $table->text('content')->nullable()->comment('内容');
            $table->string('image_path')->comment('图片路径');
            $table->string('link')->comment('链接');

            $table->tinyInteger('status')->default(0)->comment('Status');

            $table->dateTime('expired_at')->nullable()->comment('过期时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carousels');
    }
}
