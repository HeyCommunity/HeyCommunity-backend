<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostThumbController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id'       =>  'required|integer',
            'type'          =>  'required|string|in:thumb_up,thumb_down',
            'value'         =>  'required|boolean',
        ]);

        $user = $request->user();
        $thumbFieldName = $request->get('type') . '_num';

        $post = Post::findOrFail($request->get('post_id'));

        if ($request->get('value')) {
            // 创建 Thumb
            $thumb = $post->thumbs()->firstOrCreate([
                'user_id'       =>  $user->id,
                'entity_type'   =>  Post::class,
                'type'          =>  $request->get('type'),
            ]);
            if ($thumb->wasRecentlyCreated) $post->increment($thumbFieldName);

            // 删除相反的 Thumb
            if ($request->get('type') === 'thumb_up') $reverseType = 'thumb_down';
            if ($request->get('type') === 'thumb_down') $reverseType = 'thumb_up';
            if ($count = $post->thumbs()->where('type', $reverseType)->delete()) {
                $post->decrement(($reverseType . '_num'), $count);
            }
        } else {
            // 删除 Thumb
            if ($count = $post->thumbs()->where('type', $request->get('type'))->delete()) {
                $post->decrement($thumbFieldName, $count);
            }
        }

        return new PostResource($post);
    }
}
