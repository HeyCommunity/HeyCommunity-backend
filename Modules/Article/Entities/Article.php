<?php

namespace Modules\Article\Entities;

use App\Casts\Assert;
use App\Models\Model;
use Modules\Article\Database\factories\ArticleFactory;

class Article extends Model
{
    /**
     * casts
     */
    protected $casts = [
        'cover'             =>  Assert::class,
        'published_at'      =>  'datetime',
    ];

    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

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
}
