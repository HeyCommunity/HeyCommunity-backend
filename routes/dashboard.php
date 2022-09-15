<?php

use Illuminate\Support\Facades\Route;

//
// 管理平台
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.index');

    // 用户
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('dashboard.users.index');
        Route::get('{user}', 'UserController@show')->name('dashboard.users.show')->where('user', '[0-9]+');
    });

    // 评论
    Route::prefix('comments')->group(function () {
        Route::get('/', 'CommentController@index')->name('dashboard.comments.index');
        Route::get('{comment}', 'CommentController@show')->name('dashboard.comments.show')->where('comment', '[0-9]+');
    });

    // 点赞
    Route::prefix('')->group(function () {
        Route::get('thumbs', 'ThumbController@index')->name('dashboard.thumbs.index');
    });

    // 用户报告
    Route::prefix('user-reports')->group(function () {
        Route::get('/', 'UserReportController@index')->name('dashboard.user-reports.index');
    });

    // 数据分析
    Route::prefix('analytics')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard.analytics.users');
        })->name('dashboard.analytics.index');

        Route::get('increases', 'Analytics\IncreaseController@index')->name('dashboard.analytics.increases');

        Route::get('users', 'Analytics\UserController@index')->name('dashboard.analytics.users');
    });

    // 访客日志
    Route::prefix('visitor-logs')->group(function () {
        Route::get('/', 'VisitorLogController@index')->name('dashboard.visitor-logs.index');
        Route::get('date', 'VisitorLogController@date')->name('dashboard.visitor-logs.date');
    });

    // 其他
    Route::prefix('')->group(function () {
        Route::get('iframes/telescope', function () {
            return view('dashboard.iframes.iframe', ['iframeUrl' => 'dashboard/telescope']);
        })->name('dashboard.iframes.telescope');

        Route::get('iframes/laravel-log-viewer', function () {
            return view('dashboard.iframes.iframe', ['iframeUrl' => 'dashboard/laravel-log-viewer']);
        });

        Route::get('iframes/heycommunity-log-viewer', function () {
            return view('dashboard.iframes.iframe', ['iframeUrl' => 'dashboard/heycommunity-log-viewer']);
        });
    });
});
