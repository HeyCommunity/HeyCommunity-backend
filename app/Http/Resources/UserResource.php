<?php

namespace App\Http\Resources;

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

        // TODO
        $data['post_num']               =   random_int(1, 100);
        $data['got_post_comment_num']   =   random_int(1, 100);
        $data['got_post_thumb_up_num']  =   random_int(1, 100);

        $data['post_num']               =   0;
        $data['got_post_comment_num']   =   0;
        $data['got_post_thumb_up_num']  =   0;

        return $data;
    }
}
