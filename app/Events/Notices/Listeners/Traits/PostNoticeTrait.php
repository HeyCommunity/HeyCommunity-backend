<?php

namespace App\Events\Notices\Listeners\Traits;

use Illuminate\Support\Str;

trait PostNoticeTrait
{
    /**
     * 发送动态点赞通知.
     */
    public function sendPostThumbUpNotice($notice)
    {
        $tmplId = $this->thumbUpTempId;
        $sender = $notice->sender;
        $post = $notice->entity->entity;

        $page = $this->wxappPostDetailPage . '?id=' . $post->id;
        $data = [
            'thing1' => ['value' => Str::limit('动态: ' . $post->content, 20)],
            'thing2' => ['value' => Str::limit($sender->nickname, 20)],
            'time3' => ['value' => date('Y/m/d H:i:s')],
        ];

        $this->send($notice->type, $tmplId, $notice->user, $data, $page);
    }

    /**
     * 发送动态评论点赞通知.
     */
    public function sendPostCommentThumbUpNotice($notice)
    {
        $tmplId = $this->thumbUpTempId;
        $sender = $notice->sender;
        $comment = $notice->entity->entity;
        $post = $comment->entity;

        $page = $this->wxappPostDetailPage . '?id=' . $post->id;
        $data = [
            'thing1' => ['value' => Str::limit('动态评论: ' . $comment->content, 20)],
            'thing2' => ['value' => Str::limit($sender->nickname, 20)],
            'time3' => ['value' => date('Y/m/d H:i:s')],
        ];

        $this->send($notice->type, $tmplId, $notice->user, $data, $page);
    }

    /**
     * 发送动态评论通知.
     */
    public function sendPostCommentNotice($notice)
    {
        $tmplId = $this->commentTempId;
        $sender = $notice->sender;
        $comment = $notice->entity;
        $post = $comment->entity;

        $page = $this->wxappPostDetailPage . '?id=' . $post->id;
        $data = [
            'thing4'    =>  ['value' => Str::limit('动态: ' . $post->content, 20)],
            'thing1'    =>  ['value' => Str::limit($comment->content, 20)],
            'thing3'    =>  ['value' => Str::limit($sender->nickname, 20)],
            'time2' => ['value' => date('Y/m/d H:i:s')],
        ];

        $this->send($notice->type, $tmplId, $notice->user, $data, $page);
    }

    /**
     * 发送动态评论回复通知.
     */
    public function sendPostCommentReplyNotice($notice)
    {
        $tmplId = $this->replyTempId;
        $sender = $notice->sender;
        $comment = $notice->entity;
        $parentComment = $comment->parent;
        $post = $comment->entity;

        $page = $this->wxappPostDetailPage . '?id=' . $post->id;
        $data = [
            'thing1'    =>  ['value' => Str::limit($parentComment->content, 20)],
            'thing2'    =>  ['value' => Str::limit($comment->content, 20)],
            'thing3'    =>  ['value' => Str::limit($sender->nickname, 20)],
            'time4' => ['value' => date('Y/m/d H:i:s')],
        ];

        $this->send($notice->type, $tmplId, $notice->user, $data, $page);
    }
}
