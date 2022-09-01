<?php

Route::prefix('api/articles')->group(function () {
    Route::get('/', 'ArticleController@index')->name('api.articles.index');
    Route::get('latest-5', 'ArticleController@latest5')->name('api.articles.latest-5');
    Route::get('{article}', 'ArticleController@show')->name('api.articles.show')->where('article', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
    });
});

Route::prefix('api/article-categories')->group(function () {
    Route::get('/', 'ArticleController@categories')->name('api.article-categories.index');
});
