<?php

namespace App\Http\Resources;

use App\Models\Common\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['got_post_comment_num']   =   $this->posts()->sum('comment_num');
        $data['got_post_thumb_up_num']  =   $this->posts()->sum('thumb_up_num');

        return $data;
    }
}
