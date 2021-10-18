<?php

namespace App\Http\Controllers\Api\Common;

use App\Events\Notices\MakeNoticeEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Common\Thumb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThumbController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'entity_type'   =>  'required|string',
            'entity_id'     =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $user = Auth::guard('sanctum')->user();
        $entity = $this->getEntity($request);
        $entityType = $request->get('entity_type');
        $type = $request->get('type');
        $value = $request->get('value');
        $noticeType = $entityType . '_thumb_up';

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
}
