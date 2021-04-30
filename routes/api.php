<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoticeController;

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

Route::get('/system/settings', [\App\Http\Controllers\API\SystemController::class, 'settings']);

Route::get('/users/login', [UserController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/users/logout', [UserController::class, 'logout']);
    Route::get('/users/mine', [UserController::class, 'mineShow']);
    Route::post('/users/mine', [UserController::class, 'mineUpdate']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/notices', [NoticeController::class, 'index']);
});


Route::get('posts', [\App\Http\Controllers\Api\Post\PostController::class, 'index']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('posts', [\App\Http\Controllers\Api\Post\PostController::class, 'store']);
    Route::post('post-images', [\App\Http\Controllers\Api\Post\PostImageController::class, 'store']);
    Route::post('post-thumbs', [\App\Http\Controllers\Api\Post\PostThumbController::class, 'store']);
    Route::post('post-comments', [\App\Http\Controllers\Api\Post\PostCommentController::class, 'store']);
});
