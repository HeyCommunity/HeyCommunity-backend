<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $data['user_bio'] = $this->user->bio;
        $data['comments'] = $this->getComments();
        $data['thumbs'] = $this->getThumbs();
        $data['content_preview'] = $this->getContentPreview();
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
     * getContentPreview
     */
    protected function getContentPreview()
    {
        return Str::limit($this->content, 260);
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

    /**
     * getThumbs
     */
    protected function getThumbs()
    {
        $thumbs = $this->thumbs()->latest()->get();

        $result = [];
        foreach ($thumbs as $index => $thumb) {
            $result[$index] = [
                'id'            =>  $thumb->id,
                'user_id'       =>  $thumb->user->id,
                'user_nickname' =>  $thumb->user->nickname,
                'user_avatar'   =>  $thumb->user->avatar,
                'user_bio'      =>  $thumb->user->bio,
                'created_at'    =>  $thumb->created_at,
            ];
        }

        return $result;
    }
}
