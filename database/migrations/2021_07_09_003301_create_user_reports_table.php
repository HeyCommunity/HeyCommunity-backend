<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->index()->unsigned()->nullable()->comment('user id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('entity_class')->index()->comment('Belong Entity Class');
            $table->integer('entity_id')->index()->unsigned()->comment('Belong Entity ID');

            $table->tinyInteger('type_id')->nullable()->comment('User Report Type ID');
            $table->string('content')->nullable()->comment('User Report Content Text');

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
        Schema::dropIfExists('user_reports');
    }
}
