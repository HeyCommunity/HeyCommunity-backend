<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * 列表页
     */
    public function index(Request $request)
    {
        $carousels = Carousel::paginate();

        // return view('dashboard.--template--.index', ['models' => $carousels]);

        return view('dashboard.carousels.index', compact('carousels'));
    }
}
