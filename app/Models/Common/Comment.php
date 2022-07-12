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
    public function commentable()
    {
        return $this->morphTo('commentable', 'entity_class', 'entity_id')->withTrashed();
    }

    /**
     * Related EntityModel
     */
    public function entity()
    {
        // return $this->belongsTo($this->entity_class, 'entity_id')->withTrashed();     // TODO: 测试新的关联写法，一段时间后删除
        return $this->morphTo('commentable', 'entity_class', 'entity_id')->withTrashed();
    }

    /**
     * Related ParentComment
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->with('user');
    }

    /**
     * Related Thumb
     */
    public function thumbs()
    {
        return $this->morphMany(Thumb::class, 'thumbable', 'entity_class', 'entity_id');
    }

    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
