<?php

Route::prefix('api/activities')->group(function () {
    Route::get('/', 'ActivityController@index')->name('api.activities.index');
    Route::get('{activity}', 'ActivityController@show')->name('api.activities.show')->where('activity', '[0-9]+');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('{activity}/register', 'ActivityController@register')->name('api.activities.register')->where('activity', '[0-9]+');
    });
});
