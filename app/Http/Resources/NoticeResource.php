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

        $data['sender']                     =   $this->sender;
        $data['created_at_for_humans']      =   $this->created_at_for_humans;
        $data['type_name']                  =   $this->getNoticeTypeName();
        list($data['content'], $data['wxapp_redirect_url']) = $this->getNoticeData();

        return $data;
    }

    /**
     * Get notice type name
     */
    protected function getNoticeTypeName()
    {
        if (isset(Notice::$types[$this->type])) return Notice::$types[$this->type];

        return '未知';
    }

    /**
     * Get notice data
     */
    protected function getNoticeData()
    {
        $content = null;
        $wxappRedirectUrl = null;

        $postDetailPageUrl = '/modules/post/pages/detail/index';

        switch ($this->type) {
            case 'post_thumb_up':
                $content = $this->entity->entity->content;
                $postId = $this->entity->entity->id;
                $wxappRedirectUrl = $postDetailPageUrl . '?id=' . $postId;
                break;
            case 'post_comment_thumb_up':
                $content = $this->entity->entity->content;
                $postId = $this->entity->entity->entity->id;
                $wxappRedirectUrl = $postDetailPageUrl . '?id=' . $postId;
                break;
            case 'post_comment':
            case 'post_comment_reply':
                $content = $this->entity->content;
                $postId = $this->entity->entity->id;
                $wxappRedirectUrl = $postDetailPageUrl . '?id=' . $postId;
                break;
            default:
                $content = '未知消息内容';
                break;
        }

        if (! $content) $content = '未知消息内容';

        return [$content, $wxappRedirectUrl];
    }
}
