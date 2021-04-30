<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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

        $data['sender']     =   $this->sender;
        $data['content']    =   $this->getNoticeContent();
        $data['created_at_for_humans'] = $this->created_at_for_humans;

        return $data;
    }

    /**
     * Get notice content
     */
    protected function getNoticeContent()
    {
        if ($this->type === 'post_thumb_up') {
            return $this->entity->entity->content;
        }

        if ($this->type === 'post_comment') {
            return $this->entity->content;
        }

        return null;
    }
}
