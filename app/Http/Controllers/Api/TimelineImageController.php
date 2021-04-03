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

        $timelineImage = TimelineImage::create([
            'user_id'       =>  null,               // Todo
            'file_path'     =>  $request->file('file')->store('uploads/timelines/images'),
        ]);

        return new \App\Http\Resources\CommonResource($timelineImage);
    }
}
