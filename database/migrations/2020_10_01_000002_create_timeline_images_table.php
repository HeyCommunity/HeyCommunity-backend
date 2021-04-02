<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('timeline_id')->index()->unsigned()->nullable()->comment('Timeline ID');
            $table->foreign('timeline_id')->references('id')->on('timelines');

            $table->string('file_path')->comment('File Path');
            $table->integer('image_width')->nullable()->comment('Image Width');
            $table->integer('image_height')->nullable()->comment('Image Height');

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
        Schema::dropIfExists('timeline_images');
    }
}
