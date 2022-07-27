<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 登入页面
     */
    public function login()
    {
        return view('web.auth.login');
    }

    /**
     * 登入处理
     */
    public function loginHandler(Request $request)
    {
        $request->validate([
            'phone'         =>  'required|phone',
            'password'      =>  'required|string',
        ]);

        if (Auth::attempt($request->only(['phone', 'password']), true)) {
            return redirect()->intended('/');
        } else {
            return back()->withInput()->withErrors([
                'phone' =>  '手机号码或密码不正确',
            ]);
        }
    }

    /**
     * 登出处理
     */
    public function logoutHandler()
    {
        Auth::logout();

        return redirect()->back();
    }
}
