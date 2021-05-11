<?php

namespace App\Models;

class Notice extends Model
{
    public static $types = [
        'post_comment'              =>  '评论动态',
        'reply_post_comment'        =>  '回复动态评论',

        'post_thumb_up'             =>  '点赞动态',
        'post_comment_thumb_up'     =>  '点赞动态评论',
    ];

    /**
     * Related User
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Related EntityModel
     */
    public function entity()
    {
        return $this->belongsTo($this->entity_class, 'entity_id')->withTrashed();
    }
}
