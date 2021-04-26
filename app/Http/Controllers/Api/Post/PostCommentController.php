<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id'       =>  'required|integer',
            'content'       =>  'required|string',
        ]);

        $user = $request->user();
        $post = Post::findOrFail($request->get('post_id'));

        $commentStatus = 0;
        if (! env('WXAPP_SETTINGS_UGC_AUDIT', true)) $commentStatus = 1;              // TODO: use config('key')
        if ($user->is_admin || $user->ugc_safety_level) $commentStatus = 1;

        $floorNumber = $post->comments()->withTrashed()->count() + 1;
        $comment = $post->comments()->create([
            'user_id'       =>  $user->id,
            'entity_type'   =>  Post::class,
            'content'       =>  $request->get('content'),
            'floor_number'  =>  $floorNumber,
            'status'        =>  $commentStatus,
        ]);

        if ($comment) $post->increment('comment_num');

        return new CommentResource($comment);
    }
}
