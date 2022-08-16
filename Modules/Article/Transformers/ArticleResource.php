<?php

namespace Modules\Article\Transformers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\ThumbResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::guard('sanctum')->user();

        $data = parent::toArray($request);

        $data['user'] = $this->user;
        $data['categories'] = $this->categories;
        $data['tags'] = $this->tags;

        $data['thumbs'] = ThumbResource::collection($this->thumbs()->latest()->get());
        $data['comments'] = CommentResource::collection($this->comments()->latest()->get());
        $data['i_have_thumb_up'] = false;
        $data['i_have_comment'] = false;

        if ($user) {
            $data['i_have_thumb_up'] = $this->thumbs()->where('type', 'thumb_up')->where('user_id', $user->id)->exists();
            $data['i_have_comment'] = $this->comments()->where('user_id', $user->id)->exists();
        }

        return $data;
    }
}
