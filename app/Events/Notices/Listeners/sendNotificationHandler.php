<?php

namespace App\Events\Notices\Listeners;

use App\Events\Notices\MakeNoticeEvent;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class sendNotificationHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MakeNoticeEvent  $event
     * @return void
     */
    public function handle(MakeNoticeEvent $event)
    {
        $notice = $event->notice;

        // 发送微信订阅消息
        // TODO: 加入队列
        // TODO: 如果用户在线则不发送
        if ($notice->entity_class === Thumb::class) {
            $this->sendThumbUpNotice($notice);
        } else if ($notice->entity_class === Comment::class) {
            $this->commentNoticeHandler($notice);
        }
    }

    /*
     * 发送点赞通知
     */
    protected function sendThumbUpNotice($notice)
    {
        if ($tmplId = config('system.wxapp.subscribe_message.post_thumb_up')) {
            try {
                $post = $notice->entity->entity;
                $sender = $notice->sender;

                $app = app('wechat.mini_program');
                $wxRes = $app->subscribe_message->send([
                    'touser'        =>  $notice->user->wx_open_id,
                    'template_id'   =>  $tmplId,
                    'page'          =>  '/pages/posts/detail/index?id=' . $post->id,
                    'data' => [
                        'thing1'    =>  ['value' => Str::limit('动态: ' . $post->content, 20)],
                        'thing2'    =>  ['value' => Str::limit($sender->nickname, 20)],
                        'time3'     =>  ['value' => date('Y年m月d日 H:i:s')],
                    ],
                ]);

                if ($wxRes['errcode']) {
                    Log::channel('hc')->warning('[WxNotice-success] 点赞通知失败', ['res' => $wxRes]);
                } else {
                    Log::channel('hc')->info('[WxNotice-success] 点赞通知成功', ['res' => $wxRes]);
                }
            } catch (\Exception $exception) {
                Log::channel('hc')->error('[WxNotice-fail] 点赞通知失败', ['exception' => $exception]);
            }
        }
    }

    /**
     * 评论通知处理
     */
    protected function commentNoticeHandler($notice)
    {
        if ($tmplId = config('system.wxapp.subscribe_message.post_comment')) {
            $post = $notice->entity->entity;
            $comment = $notice->entity;
            $sender = $notice->sender;

            if ($comment->root_id) {
                // TODO: 回复动态评论通知
            } else {
                $this->sendPostCommentNotice($tmplId, $post, $comment, $sender);        // 动态评论通知
            }
        }
    }

    /**
     * 发送动态评论通知
     */
    protected function sendPostCommentNotice($tmplId, $post, $comment, $sender)
    {
        try {
            $app = app('wechat.mini_program');
            $wxRes = $app->subscribe_message->send([
                'touser'        =>  $post->user->wx_open_id,
                'template_id'   =>  $tmplId,
                'page'          =>  '/pages/posts/index/index',
                'data' => [
                    'thing4'    =>  ['value' => Str::limit('动态: ' . $post->content, 20)],
                    'thing1'    =>  ['value' => Str::limit($comment->content, 20)],
                    'thing3'    =>  ['value' => Str::limit($sender->nickname, 20)],
                    'time2'     =>  ['value' => date('Y年m月d日 H:i:s')],
                ],
            ]);

            if ($wxRes['errcode']) {
                Log::channel('hc')->warning('[WxNotice-success] 评论通知失败', ['wxRes' => $wxRes]);
            } else {
                Log::channel('hc')->info('[WxNotice-success] 评论通知成功', ['wxRes' => $wxRes]);
            }
        } catch (\Exception $exception) {
            Log::channel('hc')->error('[WxNotice-fail] 评论通知异常', ['exception' => $exception]);
        }
    }
}
