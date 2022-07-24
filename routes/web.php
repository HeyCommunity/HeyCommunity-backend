<?php

use Illuminate\Support\Facades\Route;

//
// WEB routes
Route::namespace('App\\Http\\Controllers\\Web')->group(function () {
    Route::get('/', function () {
        return redirect()->route('web.posts.index');
    })->name('web.home');

    Route::get('debug', 'HomeController@debug')->name('web.home.debug');
});

//
// User routes
Route::namespace('App\\Http\\Controllers\\Web')->group(function () {
    Route::get('users/{user}', 'UserController@show')->name('web.users.show');
});
