<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::guard('sanctum')->user();

        $data = parent::toArray($request);
        $data = Arr::except($data, []);

        $data['user_nickname'] = $this->user->nickname;
        $data['user_avatar'] = $this->user->avatar;
        $data['comments'] = $this->getComments();
        $data['images'] = CommonResource::collection($this->images);
        $data['video'] = new CommonResource($this->video);

        $data['created_at_for_humans'] = $this->created_at_for_humans;

        $data['i_have_thumb_up'] = 0;
        $data['i_have_comment'] = 0;
        if ($user) {
            $data['i_have_thumb_up'] = $this->thumbs()->where('type', 'thumb_up')->where('user_id', $user->id)->exists();
            $data['i_have_comment'] = $this->comments()->where('user_id', $user->id)->exists();
        }

        return $data;
    }

    /**
     * getComments
     */
    protected function getComments()
    {
        $query = $this->comments()->where('status', '!=', 0)->latest();

        if (request()->is('*posts/*')) {
            $comments = $query->get();
        } else {
            $comments = $query->limit(3)->get();
        }

        return CommentResource::collection($comments);
    }
}
