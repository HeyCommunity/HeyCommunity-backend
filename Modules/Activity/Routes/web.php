<?php

Route::prefix('activities')->group(function () {
    Route::get('/', 'ActivityController@index')->name('web.activities.index');
    Route::get('{activity}', 'ActivityController@show')->name('web.activities.show')->where('activity', '[0-9]+');
});
