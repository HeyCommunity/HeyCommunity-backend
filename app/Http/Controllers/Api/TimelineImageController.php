<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Timeline\TimelineImage;
use Illuminate\Http\Request;

class TimelineImageController extends Controller
{
    /**
     * Store
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'file'      =>  'required|image',
        ]);

        $user = $request->user();

        $timelineImage = TimelineImage::create([
            'user_id'       =>  $user->id,
            'file_path'     =>  $request->file('file')->store('uploads/timelines/images'),
        ]);

        return new \App\Http\Resources\CommonResource($timelineImage);
    }
}
