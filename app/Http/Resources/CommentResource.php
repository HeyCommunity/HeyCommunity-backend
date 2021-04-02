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
        $data = Arr::only($data, [
            'id', 'root_id', 'parent_id', 'floor_number', 'user_id', 'content',
            'comment_num', 'thumb_up_num', 'thumb_down_num',
            'created_at', 'updated_at',
        ]);

        $data['user_nickname'] = $this->user->nickname;
        $data['user_avatar'] = $this->user->avatar;

        return $data;
    }
}
