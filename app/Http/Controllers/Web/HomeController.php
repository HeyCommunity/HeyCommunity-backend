<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 首页页
     */
    public function index()
    {
        return view('web.home.index');
    }
}
