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

            $table->string('type')->index()->comment('Notice Type');
            $table->string('entity_type')->index()->comment('Belong Entity Type');
            $table->integer('entity_id')->index()->unsigned()->comment('Belong Entity ID');

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
