<?php

namespace App\Models\Common;

use App\Models\Model;

class Comment extends Model
{
    use EntityTrial;

    /**
     * Statuses
     */
    public static $statuses = [
        0       =>  '待审核',
        1       =>  '已发布',
    ];

    /**
     * Related EntityModel
     */
    public function entity()
    {
        return $this->belongsTo($this->entity_class, 'entity_id')->withTrashed();
    }

    /**
     * Related ParentComment
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id')->with('user');
    }

    /**
     * Related Thumb
     */
    public function thumbs()
    {
        return $this->hasMany(Thumb::class, 'entity_id')->where('entity_class', get_class($this));
    }

    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->hasMany(get_class($this), 'parent_id', 'id');
    }
}
