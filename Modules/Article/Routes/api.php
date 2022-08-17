<?php

Route::prefix('api/articles')->group(function () {
    Route::get('/', 'ArticleController@index');
    Route::get('latest-5', 'ArticleController@latest5');
    Route::get('{article}', 'ArticleController@show')->where('article', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
    });
});

Route::prefix('api/article-categories')->group(function () {
    Route::get('/', 'ArticleController@categories');
});
