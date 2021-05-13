<?php

namespace App\Models\Post;

use App\Models\Model;

class PostVideo extends Model
{
    /**
     * Get file_path attribute
     */
    public function getFilePathAttribute($value)
    {
        return getAssetFullPath($value);
    }
}
