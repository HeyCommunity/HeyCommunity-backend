<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\Post\PostImageController;
use App\Http\Controllers\Api\UserController;
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

Route::get('/users/login', [UserController::class, 'login']);
Route::get('/users/ping', [UserController::class, 'ping']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::get('/users/mine', [UserController::class, 'mineShow']);
    Route::post('/users/mine', [UserController::class, 'mineUpdate']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/notices', [NoticeController::class, 'index']);
    Route::post('/notices/set-isread', [NoticeController::class, 'setIsReadHandler']);
    Route::post('/notices/set-unread', [NoticeController::class, 'setUnReadHandler']);
    Route::post('/notices/delete', [NoticeController::class, 'deleteHandler']);
});


Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show'])->where('post', '[0-9]+');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/delete', [PostController::class, 'destroy']);
    Route::post('posts/hidden', [PostController::class, 'hidden']);

    Route::post('post-images', [PostImageController::class, 'store']);
    Route::post('post-video', [PostController::class, 'uploadVideo']);

    Route::post('post-thumbs', [ThumbController::class, 'postThumbHandler']);
    Route::post('post-comment-thumbs', [ThumbController::class, 'postCommentThumbHandler']);

    Route::post('post-comments', [CommentController::class, 'postCommentHandler']);
    Route::post('post-comments/delete', [CommentController::class, 'postCommentDestroyHandler']);
});
