<?php

namespace App\Models;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Post\Post;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use DefaultDatetimeFormat;
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['post_num', 'comment_num', 'thumb_up_num'];

    public static $genders = [
        0       =>  '未设定',
        1       =>  '男',
        2       =>  '女',
    ];

    public static $ugcSafetyLevel = [
        0   =>  '未设定',
        1   =>  '安全',
        -1  =>  '不安全',
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
        'email_verified_at' => 'datetime',
        'wx_user_info'      => 'array',
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
     * Get UGC Status
     */
    public function getUgcStatus()
    {
        $status = 0;

        if (! config('system.ugc_audit', true)) $status = 1;
        if ($this->is_admin || $this->ugc_safety_level > 0) $status = 1;
        if ($this->ugc_safety_level < 0) $status = 0;

        return $status;
    }

    /**
     * Related Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
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
