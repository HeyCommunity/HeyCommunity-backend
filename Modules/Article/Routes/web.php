<?php

Route::prefix('dashboard/articles')->group(function() {
    Route::get('/', 'Dashboard\ArticleController@index')->name('dashboard.articles.index');
    Route::get('{article}', 'Dashboard\ArticleController@show')->name('dashboard.articles.show')->where('article', '[0-9]+');
    Route::get('create', 'Dashboard\ArticleController@create')->name('dashboard.articles.create');
    Route::post('/', 'Dashboard\ArticleController@store')->name('dashboard.articles.store');
    Route::get('{article}/edit', 'Dashboard\ArticleController@edit')->name('dashboard.articles.edit')->where('article', '[0-9]+');
    Route::post('{article}', 'Dashboard\ArticleController@update')->name('dashboard.articles.update');
});
