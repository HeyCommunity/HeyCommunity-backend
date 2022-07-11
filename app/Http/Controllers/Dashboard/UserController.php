<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $users = User::latest()->paginate();

        return view('dashboard.users.index', compact('users'));
    }
}
