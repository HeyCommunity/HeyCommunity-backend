<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag_maps', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('tag_id')->index()->unsigned()->comment('标签 ID');
            $table->foreign('tag_id')->references('id')->on('article_tags');
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
        Schema::dropIfExists('article_tag_maps');
    }
}
