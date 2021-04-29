<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCommentController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id'       =>  'required|integer',
            'content'       =>  'required|string',
        ]);

        $user = $request->user();
        $post = Post::findOrFail($request->get('post_id'));

        $commentStatus = 0;
        if (! config('system.ugc_audit', true)) $commentStatus = 1;
        if ($user->is_admin || $user->ugc_safety_level) $commentStatus = 1;

        $floorNumber = $post->comments()->withTrashed()->count() + 1;
        $comment = $post->comments()->create([
            'user_id'       =>  $user->id,
            'entity_type'   =>  Post::class,
            'content'       =>  $request->get('content'),
            'floor_number'  =>  $floorNumber,
            'status'        =>  $commentStatus,
        ]);

        $post->increment('comment_num');

        // 发送微信订阅消息
        // TODO: 如果用户在线则不发送
        // TODO: 加入队列
        if ($post->user_id != $user->id && $tmplId = config('system.wxapp.subscribe_message.post_comment')) {
            try {
                $app = app('wechat.mini_program');
                $res = $app->subscribe_message->send([
                    'touser'        =>  $post->user->wx_open_id,
                    'template_id'   =>  $tmplId,
                    'page'          =>  '/pages/posts/index/index',
                    'data' => [
                        'thing4'    =>  ['value' => Str::limit($post->content, 20)],
                        'thing1'    =>  ['value' => Str::limit($comment->content, 20)],
                        'thing3'    =>  ['value' => Str::limit($user->nickname, 20)],
                        'time2'     =>  ['value' => date('Y年m月d日 H:i:s')],
                    ],
                ]);
            } catch (\Exception $exception) {
            }
        }

        return new CommentResource($comment);
    }
}
