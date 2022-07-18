<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThumbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thumbs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('entity_class')->index()->comment('Entity Class');
            $table->integer('entity_id')->index()->unsigned()->comment('Entity ID');

            $table->string('type')->comment('Thumb Type');

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
        Schema::dropIfExists('thumbs');
    }
}
