<?php

namespace App\Http\Controllers\Api\Common;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Common\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Post;

class CommentController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'entity_type'   =>  'required|string',
            'entity_id'     =>  'required_without:comment_id|integer',
            'comment_id'    =>  'required_without:entity_id|integer',
            'content'       =>  'required|string',
        ]);

        // 小程序 内容安全检测
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkText($request->get('content'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '内容包含违规敏感信息',
            ], 403);
        }

        if ($request->get('comment_id')) {
            $noticeType = $request->get('entity_type') . '_comment_reply';
            $parentComment = Comment::findOrFail($request->get('comment_id'));
            $entity = $parentComment->entity;
        } else {
            $noticeType = $request->get('entity_type') . '_comment';
            $parentComment = null;
            $entity = $this->getEntity($request);
        }

        $user = Auth::guard('sanctum')->user();
        $rootId = null;
        $parentId = null;
        $floorNumber = $entity->comments()->withTrashed()->count() + 1;

        if ($parentComment) {
            $parentId = $parentComment->id;
            $rootId = $parentComment->root_id ?: $parentComment->id;
        }

        $comment = Comment::create([
            'user_id'       =>  $user->id,
            'entity_class'  =>  get_class($entity),
            'entity_id'     =>  $entity->id,
            'content'       =>  $request->get('content'),
            'root_id'       =>  $rootId,
            'parent_id'     =>  $parentId,
            'floor_number'  =>  $floorNumber,
            'status'        =>  1,
        ]);

        $entity->increment('comment_num');
        if ($parentComment) $parentComment->increment('comment_num');

        // 创建 Notice
        if (($parentComment && $parentComment->user_id != $user->id)
            || (!$parentComment && $entity->user_id != $user->id)
        ) {
            event(new MakeNoticeEvent(
                $noticeType,
                $parentComment ? $parentComment->user : $entity->user,
                $user,
                $comment
            ));
        }

        $comment->refresh();
        return new CommentResource($comment);
    }

    /**
     * getEntity
     */
    protected function getEntity($request)
    {
        $request->validate([
            'entity_type'   =>  'required|string',
        ]);

        switch ($request->get('entity_type')) {
            case 'post':
                $entityQuery = Post::query();
                break;
            default:
                abort('entity_type does not exist');
                break;
        }

        return $entityQuery->findOrFail($request->get('entity_id'));
    }
}
