<?php

use Illuminate\Support\Facades\Route;

//
// 管理平台
Route::prefix('dashboard')
    ->middleware(\App\Http\Middleware\HttpBasicAuthenticate::class)
    ->namespace('App\\Http\\Controllers\\Dashboard')
    ->group(function () {

    Route::get('/', 'HomeController@index')->name('dashboard.index');

    // 数据分析
    Route::prefix('analytics')->group(function () {
        Route::get('/', 'Analytics\IndexController@index')->name('dashboard.analytics.index');
        Route::get('users', 'Analytics\UserController@index')->name('dashboard.analytics.users.index');
    });

    // 用户
    Route::middleware([])->group(function () {
        Route::get('users', 'UserController@index')->name('dashboard.users.index');
    });

    // 动态
    Route::middleware([])->group(function () {
        Route::get('posts', 'PostController@index')->name('dashboard.posts.index');
    });

    // 评论
    Route::middleware([])->group(function () {
        Route::get('comments', 'CommentController@index')->name('dashboard.comments.index');
    });
});
