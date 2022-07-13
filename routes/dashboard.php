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
        Route::get('users', 'Analytics\UserController@index')->name('dashboard.analytics.users');
        Route::get('visitor-logs', 'Analytics\VisitorLogController@index')->name('dashboard.analytics.visitor-logs');
    });

    // 访客日志
    Route::prefix('visitor-logs')->group(function () {
        Route::get('/', 'VisitorLogController@index')->name('dashboard.visitor-logs.index');
        Route::get('date', 'VisitorLogController@date')->name('dashboard.visitor-logs.date');
        Route::get('analytics', 'VisitorLogController@analytics')->name('dashboard.visitor-logs.analytics');
    });

    // 用户
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('dashboard.users.index');
        Route::get('{user}', 'UserController@show')->name('dashboard.users.show')->where('user', '[0-9]+');
    });

    // 动态
    Route::prefix('posts')->group(function () {
        Route::get('/', 'PostController@index')->name('dashboard.posts.index');
        Route::get('{post}', 'PostController@show')->name('dashboard.posts.show');
    });

    // 评论
    Route::middleware([])->group(function () {
        Route::get('comments', 'CommentController@index')->name('dashboard.comments.index');
    });

    // 点赞
    Route::middleware([])->group(function () {
        Route::get('thumbs', 'ThumbController@index')->name('dashboard.thumbs.index');
    });
});
