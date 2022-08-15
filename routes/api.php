<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserReportController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ThumbController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

##
## User API
Route::get('/users/ping', [UserController::class, 'ping']);
Route::post('/users/wxapp-signup', [UserController::class, 'wxappSignup']);
Route::post('/users/wxapp-restore-login', [UserController::class, 'wxappRestoreLogin']);
Route::post('/users/wxapp-login', [UserController::class, 'wxappLogin']);
Route::get('/users/login', [UserController::class, 'login']);
Route::get('/users/{user}', [UserController::class, 'show'])->where('user', '[0-9]+');
Route::get('/users/{user}/posts', [UserController::class, 'posts'])->where('user', '[0-9]+');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::get('/users/mine', [UserController::class, 'mineShow']);
    Route::post('/users/mine-sync-wx-profile', [UserController::class, 'mineSyncWxProfile']);
    Route::post('/users/mine', [UserController::class, 'mineUpdate']);
    Route::post('/users/mine-avatar', [UserController::class, 'mineAvatarUpdate']);
    Route::post('/users/mine-cover', [UserController::class, 'mineCoverUpdate']);
});

##
## Notice API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/notices', [NoticeController::class, 'index']);
    Route::post('/notices/set-isread', [NoticeController::class, 'setIsReadHandler']);
    Route::post('/notices/set-unread', [NoticeController::class, 'setUnReadHandler']);
    Route::post('/notices/delete', [NoticeController::class, 'deleteHandler']);
});

##
## Common API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('comments', [CommentController::class, 'store']);
    Route::post('comments/delete', [CommentController::class, 'destory']);
    Route::post('thumbs', [ThumbController::class, 'store']);
});

##
## Other API
Route::get('/system/settings', [SystemController::class, 'settings']);
Route::get('/system/about', [SystemController::class, 'about']);
Route::get('/system/regulation', [SystemController::class, 'regulation']);
Route::post('user-reports', [UserReportController::class, 'store']);
