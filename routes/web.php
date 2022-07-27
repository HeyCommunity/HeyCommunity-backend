<?php

use Illuminate\Support\Facades\Route;

//
// WEB routes
Route::namespace('App\\Http\\Controllers\\Web')->group(function () {
    Route::get('/', function () {
        return redirect()->route('web.posts.index');
    })->name('web.home');

    Route::middleware(['guest'])->group(function () {
        Route::get('login', 'AuthController@login')->name('web.login');
        Route::post('login', 'AuthController@loginHandler')->name('web.login-handler');
    });
    Route::post('logout', 'AuthController@logoutHandler')->name('web.logout-handler');

    Route::get('debug', 'HomeController@debug')->name('web.home.debug');
});

//
// User routes
Route::namespace('App\\Http\\Controllers\\Web')->group(function () {
    Route::get('users/{user}', 'UserController@show')->name('web.users.show');
});
