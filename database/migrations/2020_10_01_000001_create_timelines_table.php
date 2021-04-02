<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('content')->comment('Timeline Content');

            $table->integer('read_num')->default(0)->comment('Read Number');
            $table->integer('favorite_num')->default(0)->comment('Favorite Number');
            $table->integer('comment_num')->default(0)->comment('Comment Number');
            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Number');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Down Number');

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
        Schema::dropIfExists('timelines');
    }
}
