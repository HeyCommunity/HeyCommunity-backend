<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('content')->comment('Post Content');

            $table->integer('read_num')->default(0)->comment('Read Num');
            $table->integer('favorite_num')->default(0)->comment('Favorite Num');
            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Num');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Down Num');
            $table->integer('comment_num')->default(0)->comment('Comment Num');
            $table->tinyInteger('status')->default(0)->comment('Status');

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
        Schema::dropIfExists('posts');
    }
}
