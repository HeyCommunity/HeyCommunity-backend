<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\PostImage;
use Illuminate\Http\Request;

class PostImageController extends Controller
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

        $postImage = PostImage::create([
            'user_id'       =>  $user->id,
            'file_path'     =>  $request->file('file')->store('uploads/posts/images'),
        ]);

        return new \App\Http\Resources\CommonResource($postImage);
    }
}
