<?php

Route::namespace('\\Modules\\Activity\\Http\\Controllers\\API')->group(function () {
    Route::get('activities', 'ActivityController@index');
    Route::get('activities/{activity}', 'ActivityController@show')->where('activity', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('activities/{activity}/register', 'ActivityController@register')->where('activity', '[0-9]+');
    });
});
