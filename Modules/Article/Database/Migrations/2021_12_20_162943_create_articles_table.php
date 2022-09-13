<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title')->comment('标题');
            $table->string('intro')->comment('简介');
            $table->text('content')->comment('内容');

            $table->string('cover')->nullable()->comment('封面');
            $table->string('author')->comment('作者');

            $table->integer('read_num')->default(0)->comment('Read Number');
            $table->integer('favorite_num')->default(0)->comment('Favorite Number');
            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Num');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Up Num');
            $table->integer('comment_num')->default(0)->comment('Comment Num');

            $table->boolean('is_topped')->default(0)->comment('是否置顶');
            $table->boolean('is_excellent')->default(0)->comment('是否精华');
            $table->tinyInteger('status')->default(0)->comment('Status');

            $table->dateTime('published_at')->comment('发布时间');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
