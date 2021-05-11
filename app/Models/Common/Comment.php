<?php

namespace App\Models\Common;

use App\Models\Model;

class Comment extends Model
{
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
        return $this->belongsTo($this->entity_type, 'entity_id')->withTrashed();
    }

    /**
     * Related ParentComment
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id')->with('user');
    }
}
