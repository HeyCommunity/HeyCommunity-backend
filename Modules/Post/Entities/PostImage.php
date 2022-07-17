<?php

namespace Modules\Post\Entities;

use App\Models\Model;

class PostImage extends Model
{
    /**
     * newFactory.
     */
    protected static function newFactory()
    {
        return \Modules\Post\Database\factories\PostImageFactory::new();
    }

    /**
     * Get file_path attribute.
     */
    public function getFilePathAttribute($value)
    {
        return getAssetFullPath($value);
    }
}
