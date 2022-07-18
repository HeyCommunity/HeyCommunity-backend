<?php

namespace App\Http\Controllers\Dashboard\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard.analytics.users.index');
    }
}
