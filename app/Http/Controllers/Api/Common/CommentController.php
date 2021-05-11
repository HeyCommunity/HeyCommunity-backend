<?php

namespace App\Http\Controllers\Api\Common;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Common\Comment;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Handler
     */
    public function handler($entity, $content, $noticeType, $parentComment = null)
    {
        $user = Auth::guard('sanctum')->user();

        $commentStatus = 0;
        if (! config('system.ugc_audit', true)) $commentStatus = 1;
        if ($user->is_admin || $user->ugc_safety_level) $commentStatus = 1;

        $rootId = null;
        $parentId = null;
        $floorNumber = $entity->comments()->withTrashed()->count() + 1;

        if ($parentComment) {
            $parentId = $parentComment->id;
            $rootId = $parentComment->root_id ?: $parentComment->id;
        }

        $comment = Comment::create([
            'user_id'       =>  $user->id,
            'entity_type'   =>  get_class($entity),
            'entity_id'     =>  $entity->id,
            'content'       =>  $content,
            'root_id'       =>  $rootId,
            'parent_id'     =>  $parentId,
            'floor_number'  =>  $floorNumber,
            'status'        =>  $commentStatus,
        ]);

        $entity->increment('comment_num');
        if ($parentComment) $parentComment->increment('comment_num');

        // 创建 Notice
        if (($parentComment && $parentComment->user_id != $user->id)
            || (!$parentComment && $entity->user_id != $user->id)
        ) {
            event(new MakeNoticeEvent($noticeType, $entity->user, $user, $comment));
        }


        $comment->refresh();
        return new CommentResource($comment);
    }

    /**
     * PostCommentHandler
     */
    public function postCommentHandler(Request $request)
    {
        $this->validate($request, [
            'post_id'       =>  'required_without:comment_id|integer',
            'comment_id'    =>  'required_without:post_id|integer',
            'content'       =>  'required|string',
        ]);

        if ($request->get('comment_id')) {
            $noticeType = 'reply_post_comment';
            $comment = Comment::findOrFail($request->get('comment_id'));
            $post = $comment->entity;
        } else {
            $noticeType = 'post_comment';
            $comment = null;
            $post = Post::findOrFail($request->get('post_id'));
        }

        return $this->handler($post, $request->get('content'), $noticeType, $comment);
    }
}
