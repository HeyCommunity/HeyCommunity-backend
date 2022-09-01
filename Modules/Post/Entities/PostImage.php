<?php

namespace Modules\Post\Entities;

use App\Casts\Assert;
use App\Models\Model;

class PostImage extends Model
{
    /**
     * 数据转换
     */
    protected $casts = [
        'file_path'     =>  Assert::class,
    ];

    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return \Modules\Post\Database\factories\PostImageFactory::new();
    }
}
