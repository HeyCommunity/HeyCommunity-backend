<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * 通知列表
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $notices = Notice::where('user_id', $user->id)
            ->latest()->paginate();

        return NoticeResource::collection($notices);
    }

    /**
     * 设为已读
     */
    public function setIsReadHandler(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $notice = Notice::findOrFail($request->get('id'));
        $user = $request->user();

        // 权限校验
        if ($notice->user_id !== $user->id) return response(['message' => '非法请求'], 403);

        $notice->update([
            'is_read'   =>  true,
            'read_at'   =>  now(),
        ]);

        return new NoticeResource($notice);
    }

    /**
     * 设为未读
     */
    public function setUnReadHandler(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $notice = Notice::findOrFail($request->get('id'));
        $user = $request->user();

        // 权限校验
        if ($notice->user_id !== $user->id) return response(['message' => '非法请求'], 403);

        $notice->update([
            'is_read'   =>  false,
            'read_at'   =>  null,
        ]);

        return new NoticeResource($notice);
    }

    /**
     * 删除
     */
    public function deleteHandler(Request $request)
    {
        $request->validate([
            'id'        =>  'required|integer',
        ]);

        $notice = Notice::findOrFail($request->get('id'));
        $user = $request->user();

        // 权限校验
        if ($notice->user_id !== $user->id) return response(['message' => '非法请求'], 403);

        $notice->delete();

        return null;
    }
}
