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
}
