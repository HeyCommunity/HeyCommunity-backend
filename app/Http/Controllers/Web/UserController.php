<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * 详情页
     */
    public function show(User $user)
    {
        return view('web.users.show', compact('user'));
    }
}
