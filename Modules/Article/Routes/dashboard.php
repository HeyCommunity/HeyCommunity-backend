<?php

Route::prefix('dashboard/articles')->group(function() {
    Route::get('/', 'ArticleController@index')->name('dashboard.articles.index');
    Route::get('{article}', 'ArticleController@show')->name('dashboard.articles.show')->where('article', '[0-9]+');
    Route::get('create', 'ArticleController@create')->name('dashboard.articles.create');
    Route::post('/', 'ArticleController@store')->name('dashboard.articles.store');
    Route::get('{article}/edit', 'ArticleController@edit')->name('dashboard.articles.edit')->where('article', '[0-9]+');
    Route::post('{article}', 'ArticleController@update')->name('dashboard.articles.update');
});

Route::prefix('dashboard')->group(function() {
    Route::any('article-categories/{articleCategory}/delete', 'ArticleCategoryController@destroy')->name('dashboard.article-categories.delete');
    Route::name('dashboard')->resource('article-categories', 'ArticleCategoryController');

    Route::any('article-tag/{articleTag}/delete', 'ArticleTagController@destroy')->name('dashboard.article-tags.delete');
    Route::name('dashboard')->resource('article-tags', 'ArticleTagController');
});
