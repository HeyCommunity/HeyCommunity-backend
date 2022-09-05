<?php

Route::prefix('dashboard/posts')->group(function () {
    Route::get('/', 'PostController@index')->name('dashboard.posts.index');
    Route::get('{post}', 'PostController@show')->name('dashboard.posts.show');

    Route::any('{post}/set-visible', 'PostController@setVisible')->name('dashboard.posts.set-visible');
    Route::any('{post}/set-hidden', 'PostController@setHidden')->name('dashboard.posts.set-hidden');
    Route::any('{post}/destroy', 'PostController@destroy')->name('dashboard.posts.destroy');
});
