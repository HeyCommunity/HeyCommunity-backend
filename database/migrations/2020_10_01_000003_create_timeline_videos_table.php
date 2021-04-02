<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('timeline_id')->index()->unsigned()->nullable()->comment('Timeline ID');
            $table->foreign('timeline_id')->references('id')->on('timelines');

            $table->string('file_path')->comment('File Path');
            $table->time('duration')->nullable()->comment('Video duration');
            $table->integer('size')->nullable()->comment('Video size');

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
        Schema::dropIfExists('timeline_videos');
    }
}
