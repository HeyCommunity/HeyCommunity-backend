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
        $data['type_name']  =   Notice::$types[$this->type];
        $data['created_at_for_humans'] = $this->created_at_for_humans;
        list($data['content'], $data['wxapp_redirect_url']) = $this->getNoticeData();

        return $data;
    }

    /**
     * Get notice data
     */
    protected function getNoticeData()
    {
        $content = null;
        $wxappRedirectUrl = null;

        switch ($this->type) {
            case 'post_thumb_up':
                $content = $this->entity->entity->content;
                $postId = $this->entity->entity->id;
                $wxappRedirectUrl = '/pages/posts/detail/index?id=' . $postId;
                break;
            case 'post_comment_thumb_up':
                $content = $this->entity->entity->content;
                $postId = $this->entity->entity->entity->id;
                $wxappRedirectUrl = '/pages/posts/detail/index?id=' . $postId;
                break;
            case 'post_comment':
                $content = $this->entity->content;
                $postId = $this->entity->entity->id;
                $wxappRedirectUrl = '/pages/posts/detail/index?id=' . $postId;
                break;
            case 'post_comment_reply':
                $content = $this->entity->content;
                $postId = $this->entity->entity->id;
                $wxappRedirectUrl = '/pages/posts/detail/index?id=' . $postId;
                break;
            default:
                $content = '未知消息内容';
                break;
        }

        if (! $content) $content = '未知消息内容';

        return [$content, $wxappRedirectUrl];
    }

    protected function getWxAppRedirectUrl()
    {
        $postId = null;


        return '/pages/posts/detail/index?id=' + $postId;
    }
}
