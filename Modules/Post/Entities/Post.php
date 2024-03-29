<?php

namespace Modules\Post\Entities;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Model;

class Post extends Model
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
        2       =>  '已下架',
    ];

    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return \Modules\Post\Database\factories\PostFactory::new();
    }

    /**
     * Related PostImage
     */
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    /**
     * Related VideoImage
     */
    public function video()
    {
        return $this->hasOne(PostVideo::class);
    }

    /**
     * 状态名称 Attr
     */
    public function getStatusNameAttribute()
    {
        return self::$statuses[$this->getAttribute('status')] ?? '未知';
    }

    /**
     * 图片数量 attr
     */
    public function getImageNumAttribute()
    {
        return $this->images()->count();
    }
}
