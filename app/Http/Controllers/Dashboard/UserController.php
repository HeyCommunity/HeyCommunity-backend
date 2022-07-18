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
            'order-by'          =>  'nullable|string',
            'order-direction'   =>  'nullable|string|in:DESC,ASC',
        ]);

        $userQuery = User::query();

        // OrderBy
        $requestOrderBy = $request->get('order-by');
        $requestOrderDirection = $request->get('order-direction');
        switch ($requestOrderBy) {
            case 'last_active_at':
                $userQuery->orderBy('last_active_at', $requestOrderDirection ?: 'DESC');
                break;
            case 'created_at':
                $userQuery->orderBy('created_at', $requestOrderDirection ?: 'DESC');
                break;
            default:
                $userQuery->orderBy('last_active_at', $requestOrderDirection ?: 'DESC');
                view()->share('requestOrderBy', 'last_active_at');
                view()->share('requestOrderDirection', 'DESC');
                break;
        }

        $users = $userQuery->paginate()->appends([
            'order-by'          =>  $request->get('order-by'),
            'order-direction'   =>  $request->get('order-direction')
        ]);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * 详情页
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }
}
