<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Common\Comment;
use App\Models\Post\Post;
use App\Models\UserReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'      =>  'required|in:post,comment',
            'entity_id' =>  'required|integer',
        ]);

        $entityClass = null;
        switch ($request->get('type')) {
            case 'post':
                $entityClass = Post::class;
                break;
            case 'comment':
                $entityClass = Comment::class;
                break;
            default:
                abort(503, 'type parameter is invalid');
                break;
        }

        $user = Auth::guard('sanctum')->user();
        $data = [
            'user_id'       =>  $user ? $user->id : null,
            'entity_class'  =>  $entityClass,
            'entity_id'     =>  $request->get('entity_id'),
        ];
        $userReport = UserReport::create($data);

        return new CommonResource($userReport);
    }
}
