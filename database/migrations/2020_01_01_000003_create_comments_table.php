<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('root_id')->index()->unsigned()->nullable()->comment('Root ID');
            $table->bigInteger('parent_id')->index()->unsigned()->nullable()->comment('Comment ID');
            $table->integer('floor_number')->comment('Comment Floor Number');

            $table->bigInteger('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('entity_type')->index()->comment('Belong Entity Type');
            $table->integer('entity_id')->index()->unsigned()->comment('Belong Entity ID');

            $table->text('content')->comment('Comment Content');

            $table->integer('thumb_up_num')->default(0)->comment('Thumb Up Num');
            $table->integer('thumb_down_num')->default(0)->comment('Thumb Up Num');
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
        Schema::dropIfExists('comments');
    }
}
