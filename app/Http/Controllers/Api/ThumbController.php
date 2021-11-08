<?php

namespace App\Http\Controllers\Api;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Post;

class ThumbController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'entity_class'  =>  'required|string',
            'entity_id'     =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $user = Auth::guard('sanctum')->user();
        $type = $request->get('type');
        $value = $request->get('value');

        // 实体
        $entityClass = $request->get('entity_class');
        $entity = $entityClass::findOrFail($request->get('entity_id'));

        // 通知类型
        $noticeType = $this->getNoticeType($entity);

        if ($value) {
            $thumb = Thumb::createThumbHandler($entity, $type);

            // 创建 Notice
            if ($entity->user_id != $user->id) {
                event(new MakeNoticeEvent($noticeType, $entity->user, $user, $thumb));
            }

            return new CommonResource($thumb);
        } else {
            Thumb::deleteThumbHandler($entity, $type, $user);

            return response()->json(['message' => '取消点赞成功'], 202);
        }
    }

    /**
     * getEntity
     */
    public function getEntity(Request $request)
    {
        $request->validate([
            'entity_type'   =>  'required|string',
        ]);

        switch ($request->get('entity_type')) {
            case 'post':
                $entityQuery = Post::query();
                break;
            case 'post_comment':
                $entityQuery = Comment::query();
                break;
            default:
                abort('entity_type does not exist');
                break;
        }

        return $entityQuery->findOrFail($request->get('entity_id'));
    }

    /**
     * getNoticeType
     */
    public function getNoticeType($entity)
    {
        $rootEntityTypePrefix = null;
        if ($entity->entity) $rootEntityTypePrefix = mb_strtolower(class_basename($entity->entity)) . '_';

        $entityType = mb_strtolower(class_basename($entity));
        return $rootEntityTypePrefix . $entityType . '_thumb_up';
    }
}
