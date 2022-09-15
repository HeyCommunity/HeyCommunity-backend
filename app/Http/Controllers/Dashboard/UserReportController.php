<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserReport;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $userReports = UserReport::latest()->paginate();

        return view('dashboard.user-reports.index', compact('userReports'));
    }
}
