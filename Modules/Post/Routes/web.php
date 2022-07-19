<?php

Route::namespace('Web')->prefix('posts')->group(function() {
    Route::get('/', 'PostController@index')->name('web.posts.index');
});
