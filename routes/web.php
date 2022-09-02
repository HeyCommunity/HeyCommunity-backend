<?php

use Illuminate\Support\Facades\Route;

//
// WEB routes
Route::prefix('')->group(function () {
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
Route::prefix('users')->group(function () {
    Route::get('{user}', 'UserController@show')->name('web.users.show');
});

//
// dev routes
if (app()->environment(['local'])) {
    Route::prefix('debug')->group(function () {
        Route::get('/', 'DebugController@index')->name('web.debug.index');
    });
}
