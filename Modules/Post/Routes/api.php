<?php

use Illuminate\Http\Request;
use Modules\Post\Http\Controllers\Api\PostController;

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
