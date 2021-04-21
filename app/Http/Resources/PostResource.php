<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        $data = parent::toArray($request);
        $data = Arr::only($data, [
            'id', 'user_id', 'content',
            'read_num', 'favorite_num', 'comment_num', 'thumb_up_num', 'thumb_down_num',
            'created_at', 'updated_at',
        ]);

        $data['user_nickname'] = $this->user->nickname;
        $data['user_avatar'] = $this->user->avatar;
        $data['comments'] = CommentResource::collection($this->comments()->limit(3)->latest()->get());
        $data['images'] = CommonResource::collection($this->images);

        $data['created_at_for_humans'] = $this->created_at_for_humans;

        $data['i_have_thumb_up'] = 0;
        $data['i_have_comment'] = 0;
        if ($user) {
            $data['i_have_thumb_up'] = $this->thumbs()->where('type', 'thumb_up')->where('user_id', $user->id)->exists();
            $data['i_have_comment'] = $this->comments()->where('user_id', $user->id)->exists();
        }

        return $data;
    }
}
