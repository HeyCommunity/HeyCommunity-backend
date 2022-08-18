<?php

namespace App\Models;

class Notice extends Model
{
    public static $types = [
        'post_thumb_up'             =>  '点赞动态',
        'post_comment_thumb_up'     =>  '点赞动态评论',
        'post_comment'              =>  '评论动态',
        'post_comment_reply'        =>  '回复动态评论',

        'article_thumb_up'             =>  '点赞文章',
        'article_comment_thumb_up'     =>  '点赞文章评论',
        'article_comment'              =>  '评论文章',
        'article_comment_reply'        =>  '回复文章评论',

        'activity_thumb_up'             =>  '点赞活动',
        'activity_comment_thumb_up'     =>  '点赞活动评论',
        'activity_comment'              =>  '评论活动',
        'activity_comment_reply'        =>  '回复活动评论',
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
        return $this->morphTo('entity', 'entity_class', 'entity_id')->withTrashed();
    }
}
