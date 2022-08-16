<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoryMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_category_maps', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->index()->unsigned()->comment('分类 ID');
            $table->foreign('category_id')->references('id')->on('article_categories');
            $table->bigInteger('article_id')->index()->unsigned()->comment('文章 ID');
            $table->foreign('article_id')->references('id')->on('articles');

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
        Schema::dropIfExists('article_category_maps');
    }
}
