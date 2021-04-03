<?php

namespace App\Models\Timeline;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimelineImage extends Model
{
    use HasFactory;

    /**
     * Get file_path attribute
     */
    public function getFilePathAttribute($value)
    {
        return getAssetFullPath($value);
    }
}
