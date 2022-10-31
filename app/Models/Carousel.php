<?php

namespace App\Models;

use App\Casts\Assert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    /**
     * 数据转换
     */
    protected $casts = [
        'image_path'     =>  Assert::class,
    ];

    /**
     * 类别
     */
    public static $types = [
        'web'       =>  '网站',
        'wxapp'     =>  '微信小程序',
    ];

    /**
     * Statuses
     */
    public static $statuses = [
        0       =>  '未发布',
        1       =>  '已发布',
    ];
}
