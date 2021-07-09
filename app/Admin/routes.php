<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    // $router->get('/', 'HomeController@index')->name('home');
    $router->get('/', function () { return redirect()->to('/admin/posts'); });

    $router->resource('users', UserController::class);
    $router->resource('posts', PostController::class);
    $router->resource('comments', CommentController::class);
    $router->resource('thumbs', ThumbController::class);
    $router->resource('notices', NoticeController::class);
    $router->resource('user-reports', UserReportController::class);

    $router->get('system', 'SystemController@index')->name('admin.system');
    $router->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
