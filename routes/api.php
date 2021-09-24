<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserReportController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\Common\ThumbController;
use App\Http\Controllers\Api\Common\CommentController;

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

Route::get('/system/settings', [SystemController::class, 'settings']);
Route::get('/system/about', [SystemController::class, 'about']);

##
## User API
Route::get('/users/login', [UserController::class, 'login']);
Route::get('/users/ping', [UserController::class, 'ping']);
Route::get('/users/{user}', [UserController::class, 'show'])->where('user', '[0-9]+');
Route::get('/users/{user}/posts', [UserController::class, 'posts'])->where('user', '[0-9]+');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::get('/users/mine', [UserController::class, 'mineShow']);
    Route::post('/users/mine', [UserController::class, 'mineUpdate']);
    Route::post('/users/mine-avatar', [UserController::class, 'mineAvatarUpdate']);
    Route::post('/users/mine-cover', [UserController::class, 'mineCoverUpdate']);
    Route::post('/users/mine-info', [UserController::class, 'mineInfoUpdate']);
});


##
## UserReport API
Route::post('user-reports', [UserReportController::class, 'store']);


##
## Notice API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/notices', [NoticeController::class, 'index']);
    Route::post('/notices/set-isread', [NoticeController::class, 'setIsReadHandler']);
    Route::post('/notices/set-unread', [NoticeController::class, 'setUnReadHandler']);
    Route::post('/notices/delete', [NoticeController::class, 'deleteHandler']);
});


##
## Post API
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show'])->where('post', '[0-9]+');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/delete', [PostController::class, 'destroy']);
    Route::post('posts/hidden', [PostController::class, 'hidden']);

    Route::post('posts/upload-image', [PostController::class, 'uploadImage']);
    Route::post('posts/upload-video', [PostController::class, 'uploadVideo']);

    Route::post('posts/thumbs', [ThumbController::class, 'postThumbHandler']);
    Route::post('posts/comments/thumbs', [ThumbController::class, 'postCommentThumbHandler']);

    Route::post('posts/comments', [CommentController::class, 'postCommentHandler']);
    Route::post('posts/comments/delete', [CommentController::class, 'postCommentDestroyHandler']);
});
