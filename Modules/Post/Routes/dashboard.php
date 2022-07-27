<?php


// 动态
Route::prefix('dashboard/posts')->group(function () {
    Route::get('/', 'PostController@index')->name('dashboard.posts.index');
    Route::get('{post}', 'PostController@show')->name('dashboard.posts.show');
});
