<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Modules\Activity\Entities\Activity;
use Modules\Activity\Transformers\ActivityResource;
use Modules\Article\Entities\Article;
use Modules\Article\Transformers\ArticleResource;
use Modules\Post\Entities\Post;
use Modules\Post\Transformers\PostResource;

class FeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['entity'] = $this->getEntityResource($this->entity);

        return $data;
    }

    protected function getEntityResource($entity)
    {
        switch (get_class($entity)) {
            case Post::class:
                return new PostResource($entity);
            case Article::class:
                return new ArticleResource($entity);
            case Activity::class:
                return new ActivityResource($entity);
            default:
                return new CommonResource($entity);
        }
    }
}
