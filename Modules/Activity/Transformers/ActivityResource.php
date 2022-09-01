<?php

namespace Modules\Activity\Transformers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\CommonResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ActivityResource extends JsonResource
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

        $data =  parent::toArray($request);

        $data['images'] = [$this->cover];
        $data['comments'] = CommentResource::collection($this->comments()->latest()->get());
        $data['members'] = CommonResource::collection($this->members()->latest()->get());
        // $data['thumbs'] = $this->getThumbs();
        $data['is_expired'] = $this->started_at < now();
        $data['countdown_for_humans'] = $this->started_at->diffForHumans();

        $data['i_have_thumb_up'] = 0;
        $data['i_have_comment'] = 0;
        if ($user) {
            $data['is_registered'] = $this->members()->where('user_id', $user->id)->exists();
            $data['i_have_thumb_up'] = $this->thumbs()->where('type', 'thumb_up')->where('user_id', $user->id)->exists();
            $data['i_have_comment'] = $this->comments()->where('user_id', $user->id)->exists();
        }

        return $data;
    }
}
