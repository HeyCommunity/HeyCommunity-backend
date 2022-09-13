<?php

namespace Modules\Article\Entities;

use App\Models\Model;

class ArticleCategory extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category_maps', 'category_id', 'article_id');
    }
}
