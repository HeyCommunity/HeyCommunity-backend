<?php

namespace Modules\Post\Entities;

use App\Models\Model;

class PostVideo extends Model
{
    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return \Modules\Post\Database\factories\PostVideoFactory::new();
    }

    /**
     * Get file_path attribute
     */
    public function getFilePathAttribute($value)
    {
        return getAssetFullPath($value);
    }
}
