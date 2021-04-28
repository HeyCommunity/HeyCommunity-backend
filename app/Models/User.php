<?php

namespace App\Models;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Post\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['post_num', 'comment_num', 'thumb_up_num'];

    public static $genders = [
        0       =>  '未设定',
        1       =>  '男',
        2       =>  '女',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wx_open_id',
        'avatar',
        'nickname',
        'realname',
        'gender',
        'phone',
        'email',
        'bio',
        'password',
    ];

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
    ];

    /**
     * Get avatar attribute
     */
    public function getAvatarAttribute($value)
    {
        return getAssetFullPath($value);
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
        return $this->hasMany(Comment::class)->where('entity_type', Post::class);
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
}
