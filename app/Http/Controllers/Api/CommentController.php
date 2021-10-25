<?php

namespace App\Http\Controllers\Api;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Common\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'entity_class'  =>  'required|string',
            'entity_id'     =>  'required_without:parent_id|integer',
            'parent_id'     =>  'required_without:entity_id|integer|nullable',
            'content'       =>  'required|string',
        ]);

        // 小程序 内容安全检测
        // TODO: 封闭在工具函数中
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkText($request->get('content'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '内容包含违规敏感信息',
            ], 403);
        }

        // 实体
        $entityClass = $request->get('entity_class');
        $entity = $entityClass::findOrFail($request->get('entity_id'));

        // 实体类型和通知类型
        $entityType = mb_strtolower(class_basename($entity));
        $noticeType = $request->get('parent_id') ? $entityType . '_comment_reply' : $entityType . '_comment';

        // 父评论
        $parentComment = null;
        if ($request->get('parent_id')) $parentComment = Comment::findOrFail($request->get('parent_id'));

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
     * Destory
     */
    public function destory(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $user = $request->user();
        $comment = Comment::findOrFail($request->get('id'));

        //  判断是作者或管理员
        if ($comment->user_id === $user->id || $user->is_admin) {
            $comment->delete();

            return response()->json(['message' => '操作成功'], 202);
        } else {
            return response()->json(['message' => '无权执行此操作'], 403);
        }

    }
}
