<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User login
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'code'      =>  'required|string',
        ]);

        $miniProgram = \EasyWeChat::miniProgram();
        $res = $miniProgram->auth->session($request->code);

        $user = User::where('wx_open_id', $res['openid'])->firstOrCreate(['wx_open_id' => $res['openid']]);
        $user->token = $user->createToken('token')->plainTextToken;

        return new UserResource($user);
    }

    /**
     * User logout
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('name', 'token')->delete();

        return response()->noContent();
    }

    /**
     * 获取信息
     */
    public function mineShow(Request $request)
    {
        $user = $request->user();

        // $this->timProfileUpdate($patient);

        return new UserResource($user);
    }

    /**
     * 更新
     */
    public function mineUpdate(Request $request)
    {
        $this->validate($request, [
            'nickName'      =>  'nullable|string',
            'gender'        =>  'nullable|integer',
            'avatarUrl'     =>  'nullable|string',
            'province'      =>  'nullable|string',
            'city'          =>  'nullable|string',
        ]);

        $user = $request->user();

        $user->update([
            'nickname'          =>  $request->get('nickName'),
            'avatar'            =>  $request->get('avatarUrl'),
            'wx_province_city'  =>  $request->get('province') . ' ' . $request->get('city'),
        ]);

        // $this->timProfileUpdate($user);

        return new UserResource($user);
    }
}
