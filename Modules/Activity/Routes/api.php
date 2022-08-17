<?php

Route::prefix('api/activities')->group(function () {
    Route::get('/', 'ActivityController@index');
    Route::get('{activity}', 'ActivityController@show')->where('activity', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('{activity}/register', 'ActivityController@register')->where('activity', '[0-9]+');
    });
});
