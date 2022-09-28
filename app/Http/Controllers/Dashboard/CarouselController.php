<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * 列表页
     */
    public function index(Request $request)
    {
        $carousels = collect();
        return view('dashboard.carousels.index', compact('carousels'));
    }
}
