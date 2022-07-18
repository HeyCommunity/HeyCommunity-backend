<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('App\\Http\\Controllers\\Web')->group(function () {
    Route::get('/', function () {
        return route('web.posts.index');
    })->name('web.home');

    Route::get('debug', 'HomeController@debug')->name('web.home.debug');
});
