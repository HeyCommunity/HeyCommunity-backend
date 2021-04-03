<?php

namespace App\Models\Timeline;

use App\Models\Common\Comment;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    use HasFactory;

    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'entity_id', 'id')
            ->where('entity_type', Timeline::class);
    }

    /**
     * Related TimelineImage
     */
    public function images()
    {
        return $this->hasMany(TimelineImage::class);
    }
}
