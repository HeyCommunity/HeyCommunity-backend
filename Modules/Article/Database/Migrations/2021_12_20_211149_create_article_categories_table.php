<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('sort')->nullable()->comment('排序');

            $table->string('slug')->comment('SLUG');
            $table->string('name')->comment('名称');
            $table->string('description')->nullable()->comment('描述');

            $table->timestamps();
            $table->softDeletes();
        });

        \Modules\Article\Entities\ArticleCategory::create([
            'sort'              =>  1,
            'slug'              =>  'default',
            'name'              =>  '默认',
            'description'       =>  '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
