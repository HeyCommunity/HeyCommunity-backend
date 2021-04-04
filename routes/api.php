<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/mine-token', [UserController::class, 'mineToken']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/mine', [UserController::class, 'mineShow']);
    Route::post('/users/mine', [UserController::class, 'mineUpdate']);
});

Route::get('timelines', [\App\Http\Controllers\Api\TimelineController::class, 'index']);
Route::post('timelines', [\App\Http\Controllers\Api\TimelineController::class, 'store']);
Route::post('timeline-images', [\App\Http\Controllers\Api\TimelineImageController::class, 'store']);
