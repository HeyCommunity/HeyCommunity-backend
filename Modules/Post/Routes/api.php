<?php

use Modules\Post\Http\Controllers\Api\PostController;

Route::prefix('api/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('api.posts.index');
    Route::get('{post}', [PostController::class, 'show'])->name('api.posts.show')->where('post', '[0-9]+');
    Route::get('user-posts', [PostController::class, 'userPosts'])->name('api.posts.user-posts');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('api.posts.store');
        Route::post('delete', [PostController::class, 'destroy'])->name('api.posts.delete');
        Route::post('hidden', [PostController::class, 'hidden'])->name('api.posts.hidden');

        Route::post('upload-image', [PostController::class, 'uploadImage'])->name('api.posts.upload-image');
        Route::post('upload-video', [PostController::class, 'uploadVideo'])->name('api.posts.upload-video');
    });
});
