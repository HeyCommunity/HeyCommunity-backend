<?php

namespace App\Http\Controllers\Api\Common;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThumbController extends Controller
{
    /**
     * Handler
     */
    public function handler($entity, $type, $value, $eventType)
    {
        $user = Auth::guard('sanctum')->user();

        if ($value) {
            $thumb = Thumb::createThumbHandler($entity, $type);

            // 创建 Notice
            if ($entity->user_id != $user->id) {
                event(new MakeNoticeEvent($eventType, $entity->user, $user, $thumb));
            }

            return new CommonResource($thumb);
        } else {
            Thumb::deleteThumbHandler($entity, $type, $user);

            return response()->json(['message' => '取消点赞成功'], 202);
        }
    }

    /**
     * PostThumbHandler
     */
    public function postThumbHandler(Request $request)
    {
        $request->validate([
            'post_id'       =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $entity = Post::findOrFail($request->get('post_id'));
        return $this->handler(
            $entity,
            $request->get('type'),
            $request->get('value'),
            'post_thumb_up',
        );
    }

    /**
     * PostCommentThumbHandler
     */
    public function postCommentThumbHandler(Request $request)
    {
        $request->validate([
            'comment_id'    =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $entity = Comment::findOrFail($request->get('comment_id'));
        return $this->handler(
            $entity,
            $request->get('type'),
            $request->get('value'),
            'post_comment_thumb_up',
        );
    }
}
