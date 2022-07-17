<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Common\Comment;
use App\Models\UserReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{
    /**
     * Store.
     */
    public function store(Request $request)
    {
        $request->validate([
            'entity_class'      =>  'required',
            'entity_id'         =>  'required|integer',
        ]);

        $user = Auth::guard('sanctum')->user();
        $data = [
            'user_id'       =>  $user ? $user->id : null,
            'entity_class'  =>  $request->get('entity_class'),
            'entity_id'     =>  $request->get('entity_id'),
        ];
        $userReport = UserReport::create($data);

        return new CommonResource($userReport);
    }
}
