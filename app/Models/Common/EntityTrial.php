<?php

namespace App\Models\Common;

use Modules\Activity\Entities\Activity;
use Modules\Article\Entities\Article;
use Modules\Post\Entities\Post;

trait EntityTrial
{
    /**
     * entity_name Attr
     */
    public function getEntityNameAttribute()
    {
        switch ($this->entity_class) {
            case Comment::class:
                return '评论';
            case Post::class:
                return '动态';
            case Article::class:
                return '文章';
            case Activity::class:
                return '活动';
            default:
                return '未知';
        }
    }

}
