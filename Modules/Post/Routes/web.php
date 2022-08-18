<?php

Route::prefix('posts')->group(function () {
    Route::get('/', 'PostController@index')->name('web.posts.index');
    Route::get('{post}', 'PostController@show')->name('web.posts.show')->where('post', '[0-9]+');
});
