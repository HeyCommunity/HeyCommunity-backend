<?php

namespace App\Models\Timeline;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    /**
     * Appends
     */
    protected $appends = ['image_num'];

    /**
     * Statuses
     */
    public static $statuses = [
        0       =>  '待审核',
        1       =>  '已发布',
    ];

    /**
     * Related TimelineImage
     */
    public function images()
    {
        return $this->hasMany(TimelineImage::class);
    }

    /**
     * Related Thumb
     */
    public function thumbs()
    {
        return $this->hasMany(Thumb::class, 'entity_id', 'id')
            ->where('entity_type', self::class);
    }

    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'entity_id', 'id')
            ->where('entity_type', self::class);
    }

    /**
     * Get image_num attr
     */
    public function getImageNumAttribute()
    {
        return $this->images()->count();
    }
}
