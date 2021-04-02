<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineResource;
use App\Models\Timeline\Timeline;
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
}
