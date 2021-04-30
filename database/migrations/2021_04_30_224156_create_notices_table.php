<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->index()->unsigned()->comment('user id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->biginteger('sender_id')->index()->unsigned()->comment('user id');
            $table->foreign('sender_id')->references('id')->on('users');

            $table->string('type')->index()->comment('Notice Type');
            $table->string('entity_class')->index()->comment('Belong Entity Class');
            $table->integer('entity_id')->index()->unsigned()->comment('Belong Entity ID');

            $table->boolean('is_read')->default(0)->comment('Is Read');
            $table->timestamp('read_at')->nullable()->comment('Read Datetime');

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
        Schema::dropIfExists('notices');
    }
}
