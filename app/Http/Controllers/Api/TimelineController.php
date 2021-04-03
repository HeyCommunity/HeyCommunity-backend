<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineResource;
use App\Models\Timeline\Timeline;
use App\Models\Timeline\TimelineImage;
use App\Models\User;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Index
     */
    public function index(Request $request)
    {
        $timelines = Timeline::latest()->paginate();

        return TimelineResource::collection($timelines);
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'       =>  'required|string',
            'image_ids'     =>  'required|array',
        ]);

        $user = User::first();

        $timeline = Timeline::create([
            'user_id'   =>  $user->id,
            'content'   =>  $request->get('content'),
        ]);

        if ($request->get('image_ids')) {
            TimelineImage::whereIn('id', $request->get('image_ids'))->update([
                'timeline_id'   =>  $timeline->id,
            ]);
        }

        return new TimelineResource($timeline);
    }
}
