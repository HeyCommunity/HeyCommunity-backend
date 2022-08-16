<?php

use Illuminate\Http\Request;

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
Route::namespace('\\Modules\\Article\\Http\\Controllers\\Api')->group(function () {
    Route::get('articles', 'ArticleController@index');
    Route::get('articles/latest-5', 'ArticleController@latest5');
    Route::get('articles/{article}', 'ArticleController@show')->where('article', '[0-9]+');

    Route::get('article-categories', 'ArticleController@categories');

    Route::middleware(['auth:sanctum'])->group(function () {
    });
});
