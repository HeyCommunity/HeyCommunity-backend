<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * 通知列表
     */
    public function index()
    {
        $notices = Notice::paginate();

        return CommonResource::collection($notices);
    }
}
