<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();

            $table->string('entity_class')->index()->comment('Belong Entity Class');
            $table->integer('entity_id')->index()->unsigned()->comment('Belong Entity ID');

            $table->boolean('is_topped')->default(0)->comment('是否置顶');
            $table->smallInteger('sort')->index()->nullable()->comment('排序');

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
        Schema::dropIfExists('feeds');
    }
}
