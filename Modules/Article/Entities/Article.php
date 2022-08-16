<?php

namespace Modules\Article\Entities;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Model;

class Article extends Model
{
    /**
     * casts
     */
    protected $casts = [
        'published_at'      =>  'datetime',
    ];

    /**
     * 关联 ArticleCategory
     */
    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category_maps', 'article_id', 'category_id');
    }

    /**
     * 关联 ArticleTag
     */
    public function tags()
    {
        return $this->belongsToMany(ArticleTag::class, 'article_tag_maps', 'article_id', 'tag_id');
    }

    /**
     * 关联 Thumb
     */
    public function thumbs()
    {
        return $this->morphMany(Thumb::class, 'thumbable', 'entity_class', 'entity_id');
    }

    /**
     * Related Comment
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable', 'entity_class', 'entity_id');
    }

    /**
     * getAttr cover
     */
    public function getCoverAttribute($value)
    {
        return getImageFullPath($value);
    }
}