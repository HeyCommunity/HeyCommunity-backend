<?php

namespace App\Http\Resources;

use App\Models\Notice;
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
        $data['type']       =   Notice::$types[$this->type];
        $data['content']    =   $this->getNoticeContent();
        $data['created_at_for_humans'] = $this->created_at_for_humans;

        return $data;
    }

    /**
     * Get notice content
     */
    protected function getNoticeContent()
    {
        switch ($this->type) {
            case 'post_thumb_up':
            case 'post_comment_thumb_up':
                $content = $this->entity->entity->content;
                break;
            case 'post_comment':
                $content = $this->entity->content;
                break;
            case 'replay_post_comment':
                $content = $this->entity->content;
                break;
            default:
                $content = '未知消息内容';
                break;
        }

        if (! $content) $content = '未知消息内容';
        return $content;
    }
}
