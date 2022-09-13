<?php

use Modules\Article\Http\Controllers\Dashboard\ArticleCategoryController;
use Modules\Article\Http\Controllers\Dashboard\ArticleTagController;

Route::prefix('dashboard/articles')->group(function() {
    Route::get('/', 'ArticleController@index')->name('dashboard.articles.index');
    Route::get('{article}', 'ArticleController@show')->name('dashboard.articles.show')->where('article', '[0-9]+');
    Route::get('create', 'ArticleController@create')->name('dashboard.articles.create');
    Route::post('/', 'ArticleController@store')->name('dashboard.articles.store');
    Route::get('{article}/edit', 'ArticleController@edit')->name('dashboard.articles.edit')->where('article', '[0-9]+');
    Route::post('{article}', 'ArticleController@update')->name('dashboard.articles.update');
});

Route::namespace('\\')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('article-categories', ArticleCategoryController::class);
    Route::resource('article-tags', ArticleTagController::class);
});
