<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CommentResource extends JsonResource
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
        $data = Arr::except($data, []);

        $data['user_nickname'] = $this->user->nickname;
        $data['user_avatar'] = $this->user->avatar;
        $data['parent'] = $this->parent;

        $data['created_at_for_humans'] = $this->created_at_for_humans;

        return $data;
    }
}
