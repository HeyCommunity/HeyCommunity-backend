<?php

use Modules\Post\Http\Controllers\Api\PostController;

Route::prefix('api/posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('user-posts', [PostController::class, 'userPosts']);
    Route::get('{post}', [PostController::class, 'show'])->where('post', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', [PostController::class, 'store']);
        Route::post('delete', [PostController::class, 'destroy']);
        Route::post('hidden', [PostController::class, 'hidden']);

        Route::post('upload-image', [PostController::class, 'uploadImage']);
        Route::post('upload-video', [PostController::class, 'uploadVideo']);
    });
});
