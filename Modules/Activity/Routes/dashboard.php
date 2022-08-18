<?php

Route::prefix('dashboard/activities')->group(function () {
    Route::get('/', 'ActivityController@index')->name('dashboard.activities.index');
    Route::get('{activity}', 'ActivityController@show')->name('dashboard.activities.show')->where('activity', '[0-9]+');

    Route::get('create', 'ActivityController@create')->name('dashboard.activities.create');
    Route::post('/', 'ActivityController@store')->name('dashboard.activities.store');

    Route::get('{activity}/edit', 'ActivityController@edit')->name('dashboard.activities.edit')->where('activity', '[0-9]+');
    Route::post('{activity}', 'ActivityController@update')->name('dashboard.activities.update')->where('activity', '[0-9]+');
});
