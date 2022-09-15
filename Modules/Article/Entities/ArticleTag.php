<?php

namespace Modules\Article\Entities;

use App\Models\Model;

class ArticleTag extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category_maps', 'category_id', 'article_id');
    }
}
