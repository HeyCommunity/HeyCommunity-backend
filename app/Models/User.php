<?php

namespace App\Models;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\Post\Entities\Post;

class User extends Authenticatable
{
    use DefaultDatetimeFormat;
    use HasApiTokens, HasFactory, Notifiable;

    // TODO: post_num, comment_num, thumb_up_num 字段添加到数据表中
    protected $appends = ['post_num', 'comment_num', 'thumb_up_num'];

    public static $genders = [
        0       =>  '未设定',
        1       =>  '男',
        2       =>  '女',
    ];

    /**
     * The guarded column
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'     =>  'datetime',
        'wx_user_info'          =>  'array',
        'last_active_at'        =>  'datetime',
    ];

    /**
     * Get avatar attribute
     */
    public function getAvatarAttribute($value)
    {
        return getAssetFullPath($value);
    }

    /**
     * Get cover attribute
     */
    public function getCoverAttribute($value)
    {
        return getAssetFullPath($value);
    }

    /**
     * Related ThumbUp
     */
    public function upThumbs()
    {
        return $this->hasMany(Thumb::class)->where('type', 'thumb_up');
    }

    /**
     * Related ThumbDown
     */
    public function downThumbs()
    {
        return $this->hasMany(Thumb::class)->where('type', 'thumb_down');
    }

    /**
     * Related Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Related Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Related Comments
     */
    public function postComments()
    {
        return $this->hasMany(Comment::class)->where('entity_class', Post::class);
    }

    /**
     * Get nickname attr
     */
    public function getNicknameAttribute($value)
    {
        return Str::limit($value, 10 * 2, '');
    }

    /**
     * Get post_num attr
     */
    public function getPostNumAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * Get comment_num attr
     */
    public function getCommentNumAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Get post_num attr
     */
    public function getThumbUpNumAttribute()
    {
        return $this->upThumbs()->count();
    }

    /**
     * Get unread_notice_num attr
     */
    public function getUnreadNoticeNumAttribute()
    {
        return Notice::where(['user_id' => $this->id, 'is_read' => false])->count();
    }
}
