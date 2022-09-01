<?php

Route::prefix('articles')->group(function() {
    Route::get('/', 'ArticleController@index')->name('web.articles.index');
    Route::get('{article}', 'ArticleController@show')->name('web.articles.show')->where('article', '[0-9]+');
});
