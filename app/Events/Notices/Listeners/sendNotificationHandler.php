<?php

namespace App\Events\Notices\Listeners;

use App\Events\Notices\Listeners\Traits\PostNoticeTrait;
use App\Events\Notices\MakeNoticeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class sendNotificationHandler implements ShouldQueue
{
    use PostNoticeTrait;

    protected $enable = false;
    protected $thumbUpTempId;
    protected $commentTempId;
    protected $replyTempId;

    protected $wxappHomePage = '/pages/posts/index/index';
    protected $wxappNoticeIndexPage = '/pages/messages/index/index';
    protected $wxappPostDetailPage = '/pages/posts/detail/index';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->enable = config('system.wxapp.subscribe_message.enable');
        $this->thumbUpTempId = config('system.wxapp.subscribe_message.thumb_up_temp_id');
        $this->commentTempId = config('system.wxapp.subscribe_message.comment_temp_id');
        $this->replyTempId = config('system.wxapp.subscribe_message.reply_temp_id');
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
        // TODO: 如果用户在线则不发送
        if ($this->enable && $notice) {
            switch ($notice->type) {
                case 'post_thumb_up':
                    $this->sendPostThumbUpNotice($notice);
                    break;
                case 'post_comment_thumb_up':
                    $this->sendPostCommentThumbUpNotice($notice);
                    break;
                case 'post_comment':
                    $this->sendPostCommentNotice($notice);
                case 'post_comment_reply':
                    $this->sendPostCommentReplyNotice($notice);
                    break;
                default:
                    // 报告 未支持的通知类型
                    Log::channel('hc')->error("[WxNotice-{$notice->type}] fail:  未支持的通知类型", ['notice' => $notice]);
                    break;
            }
        } else {
            // 报告 $notice 不存在，或者未启用微信小程序订阅消息功能
            Log::channel('hc')->error("[WxNotice-{$notice->type}] fail: 未启用微信小程序订阅消息功能或者 \$notice 不存在");
        }
    }

    /**
     * send wechat mini program subscribe message
     *
     * @param $type
     * @param $tmplId
     * @param $receiver
     * @param $data
     * @param $page
     */
    protected function send($type, $tmplId, $receiver, $data, $page)
    {
        if ($tmplId) {
            try {
                $app = app('wechat.mini_program');

                $wxRes = $app->subscribe_message->send([
                    'touser' => $receiver->wx_open_id,
                    'template_id' => $tmplId,
                    'page' => $page,
                    'data' => $data,
                ]);

                if ($wxRes['errcode']) {
                    Log::channel('hc')->error("[WxNotice-{$type}] fail", ['res' => $wxRes]);
                } else {
                    Log::channel('hc')->info("[WxNotice-{$type}] success", ['res' => $wxRes]);
                }
            } catch (\Exception $exception) {
                Log::channel('hc')->error("[WxNotice-{$type}] fail", ['exception' => $exception]);
            }
        } else {
            Log::channel('hc')->error("[WxNotice-{$type}] fail: 未设定微信订阅消息模板");
        }
    }
}
