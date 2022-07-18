<?php

namespace App\Models\Common;

trait EntityTrial
{
    /**
     * entity_name Attr
     */
    public function getEntityNameAttribute()
    {
        switch ($this->entity_class) {
            case 'Modules\Post\Entities\Post':
                return '动态';
            case 'App\Models\Common\Comment':
                return '评论';
            default:
                return '未知';
        }
    }

}
