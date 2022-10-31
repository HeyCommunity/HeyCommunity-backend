<?php

use Illuminate\Support\Facades\Route;

//
// 登入和登出
Route::middleware(['guest'])->group(function () {
    Route::get('login', 'AuthController@login')->name('web.auth.login');
    Route::post('login', 'AuthController@loginHandler')->name('web.auth.login-handler');
});
Route::post('logout', 'AuthController@logoutHandler')->name('web.auth.logout-handler');

//
// 首页
Route::get('/', function () {
    return redirect()->route('web.posts.index');
})->name('web.home');

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
