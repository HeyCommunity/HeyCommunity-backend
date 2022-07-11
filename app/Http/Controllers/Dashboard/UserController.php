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
    public function index(Request $request)
    {
        $request->validate([
            'order-by'          =>  'string',
            'order-direction'   =>  'string|in:DESC,ASC',
        ]);

        $userQuery = User::query();

        // orderBy last_active_at
        if ($request->get('order-by') === 'last_active_at') {
            $direction = $request->get('order-direction') ?: 'DESC';
            $userQuery->orderBy('last_active_at', $direction);
        }

        // orderBy created_at
        if ($request->get('order-by') === 'created_at') {
            $direction = $request->get('order-direction') ?: 'DESC';
            $userQuery->orderBy('created_at', $direction);
        }

        $users = $userQuery->paginate()->appends([
            'order-by'          =>  $request->get('order-by'),
            'order-direction'   =>  $request->get('order-direction')
        ]);

        return view('dashboard.users.index', compact('users'));
    }
}
