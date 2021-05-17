<?php

namespace App\Http\Controllers\Api\Post;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostThumbController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id'       =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $user = $request->user();
        $thumbFieldName = $request->get('type') . '_num';

        $post = Post::findOrFail($request->get('post_id'));

        if ($request->get('value')) {
            // 创建 Thumb
            $thumb = $post->thumbs()->firstOrCreate([
                'user_id'       =>  $user->id,
                'entity_class'  =>  Post::class,
                'type'          =>  $request->get('type'),
            ]);

            if ($thumb->wasRecentlyCreated) {
                $post->increment($thumbFieldName);

                // notice
                if ($post->user_id != $user->id) {
                    event(new MakeNoticeEvent('post_thumb_up', $post->user, $user, $thumb));
                }

                // 发送微信订阅消息
                // TODO: 加入队列
                // TODO: 如果用户在线则不发送
                if ($post->user_id != $user->id && $tmplId = config('system.wxapp.subscribe_message.post_thumb_up')) {
                    try {
                        $app = app('wechat.mini_program');
                        $res = $app->subscribe_message->send([
                            'touser'        =>  $post->user->wx_open_id,
                            'template_id'   =>  $tmplId,
                            'page'          =>  '/pages/posts/index/index',
                            'data' => [
                                'thing1'    =>  ['value' => Str::limit($post->content, 20)],
                                'thing2'    =>  ['value' => Str::limit($user->nickname, 20)],
                                'time3'     =>  ['value' => date('Y年m月d日 H:i:s')],
                            ],
                        ]);
                    } catch (\Exception $exception) {
                    }
                }
            }

            // 删除相反的 Thumb
            if ($request->get('type') === 'thumb_up') $reverseType = 'thumb_down';
            if ($request->get('type') === 'thumb_down') $reverseType = 'thumb_up';
            if ($count = $post->thumbs()->where('type', $reverseType)->delete()) {
                $post->decrement(($reverseType . '_num'), $count);
            }

            return new CommonResource($thumb);
        } else {
            // 删除 Thumb
            if ($count = $post->thumbs()->where('type', $request->get('type'))->delete()) {
                $post->decrement($thumbFieldName, $count);
            }

            return response()->json(['message' => '取消点赞成功'], 202);
        }
    }
}
