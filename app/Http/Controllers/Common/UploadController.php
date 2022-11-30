<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * tiny-editor 图片上传
     */
    public function tinyEditorImageUpload(Request $request)
    {
        $request->validate([
            'file'      =>  'required|file',
        ]);

        $imagePath = $request->file('file')->store('uploads/tiny-editor/images');

        return response()->json([
            'location'  =>  asset($imagePath),
        ]);
    }
}
