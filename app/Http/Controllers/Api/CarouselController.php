<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index(Request $request)
    {
        if (! in_array($request->get('type'), array_keys(Carousel::$types))) {
            return redirect()->route($request->route()->getName(), ['type' => array_key_first(Carousel::$types)]);
        }

        $carousels = Carousel::where('type', $request->get('type'))
            ->where('status', 1)
            ->orderByRaw('ISNULL(sort), sort ASC')
            ->orderByDesc('id')
            ->get();

        return CommonResource::collection($carousels);
    }
}
