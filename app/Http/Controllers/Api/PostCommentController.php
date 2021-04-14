<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineResource;
use App\Models\Timeline\Timeline;
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

        $post = Timeline::findOrFail($request->get('post_id'));

        $floorNumber = $post->comments()->withTrashed()->count() + 1;
        $comment = $post->comments()->create([
            'user_id'       =>  $user->id,
            'entity_type'   =>  Timeline::class,
            'content'       =>  $request->get('content'),
            'floor_number'  =>  $floorNumber,
        ]);

        if ($comment) $post->increment('comment_num');

        return new TimelineResource($post);
    }
}
