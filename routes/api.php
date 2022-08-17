<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\FeedController;
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
Route::prefix('users')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('api.users.login');

    Route::get('ping', [UserController::class, 'ping'])->name('api.users.ping');
    Route::post('wxapp-signup', [UserController::class, 'wxappSignup'])->name('api.users.wxapp-signup');
    Route::post('wxapp-restore-login', [UserController::class, 'wxappRestoreLogin'])->name('api.users.wxapp-restore-login');
    Route::post('wxapp-login', [UserController::class, 'wxappLogin'])->name('api.users.wxapp-login');
    Route::get('{user}', [UserController::class, 'show'])->name('api.users.show')->where('user', '[0-9]+');
    Route::get('{user}/posts', [UserController::class, 'posts'])->name('api.users.posts')->where('user', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('api.users.logout');
        Route::get('mine', [UserController::class, 'mineShow'])->name('api.users.mine');
        Route::post('mine-sync-wx-profile', [UserController::class, 'mineSyncWxProfile'])->name('api.users.mine-sync-wx-profile');
        Route::post('mine', [UserController::class, 'mineUpdate'])->name('api.users.mine-update');
        Route::post('mine-avatar', [UserController::class, 'mineAvatarUpdate'])->name('api.users.mine-avatar-update');
        Route::post('mine-cover', [UserController::class, 'mineCoverUpdate'])->name('api.users.mine-cover-update');
    });
});


##
## Feed Api
Route::prefix('feeds')->group(function () {
    Route::get('/', [FeedController::class, 'index'])->name('api.feeds.index');
});


##
## Notice API
Route::prefix('notices')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [NoticeController::class, 'index'])->name('api.notices.index');
    Route::post('set-isread', [NoticeController::class, 'setIsReadHandler'])->name('api.notices.set-isread');
    Route::post('set-unread', [NoticeController::class, 'setUnReadHandler'])->name('api.notices.set-unread');
    Route::post('delete', [NoticeController::class, 'deleteHandler'])->name('api.notices.destroy');
});


##
## Common API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('comments', [CommentController::class, 'store'])->name('api.comments.store');
    Route::post('comments/delete', [CommentController::class, 'destory'])->name('api.comments.destroy');
    Route::post('thumbs', [ThumbController::class, 'store'])->name('api.thumbs.store');
});


##
## Other API
Route::get('/system/settings', [SystemController::class, 'settings'])->name('api.system.settings');
Route::get('/system/about', [SystemController::class, 'about'])->name('api.system.about');
Route::get('/system/regulation', [SystemController::class, 'regulation'])->name('api.system.regulation');
Route::post('user-reports', [UserReportController::class, 'store'])->name('api.user-reports.store');
