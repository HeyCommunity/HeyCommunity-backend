<?php

use Illuminate\Support\Facades\Route;

Route::post('uploads/tiny-editor-image-upload', 'UploadController@tinyEditorImageUpload')->name('common.uploads.tiny-editor-image-upload');
