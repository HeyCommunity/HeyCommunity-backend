<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * User ping
     */
    public function ping(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            return [
                'data'  =>  [
                    'unread_notice_num'     =>  $user->unread_notice_num,
                ],
            ];
        }

        return ['message' => 'OK'];
    }

    /**
     * User login
     */
    public function login(Request $request)
    {
        $request->validate([
            'code'      =>  'required|string',
            'user_info' =>  'nullable|string',
        ]);

        $miniProgram = \EasyWeChat::miniProgram();
        $wxRes = $miniProgram->auth->session($request->code);

        if (isset($wxRes['openid'])) {
            $user = User::firstOrCreate(['wx_open_id' => $wxRes['openid']]);
            $user->update(['last_active_at' => now()]);

            // 如果是新创建的用户，则更新头像昵称性别等资料
            $wxUserInfo = json_decode($request->get('user_info'), true);
            if ($wxUserInfo) {
                $data['wx_user_info'] = $wxUserInfo;
                if (isset($wxUserInfo['nickName']) && !$user->nickname) $data['nickname'] = $wxUserInfo['nickName'];
                if (isset($wxUserInfo['gender']) && !$user->gender) $data['gender'] = $wxUserInfo['gender'];
                if (isset($wxUserInfo['avatarUrl']) && !$user->avatar) {
                    $client = new Client();
                    $avatarData = $client->request('get', $wxUserInfo['avatarUrl'])->getBody()->getContents();
                    $avatarPath = 'uploads/users/avatars/' . Str::random(40) . '.jpg';
                    Storage::put($avatarPath, $avatarData);
                    $data['avatar'] = $avatarPath;
                }

                $user->update($data);
            }

            $user->token = $user->createToken('token')->plainTextToken;

            // logging
            Log::channel('hc')->info('[UserLogin-success] 用户登录成功', ['wxRes' => $wxRes, 'user' => $user->getAttributes(), 'headers' => $request->server]);

            return new UserResource($user);
        } else {
            // logging
            Log::channel('hc')->warning('[UserLogin-fail] 用户登录失败', ['wxRes' => $wxRes, 'headers' => $request->server]);

            return response()->json(['message' => $wxRes['errmsg']], 500);
        }
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
     * 用户信息
     */
    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * 我的信息
     */
    public function mineShow(Request $request)
    {
        $user = $request->user();

        // $this->timProfileUpdate($patient);

        return new UserResource($user);
    }

    /**
     * 更新我的资料
     */
    public function mineUpdate(Request $request)
    {
        $request->validate([
            'nickname'      =>  'required|string|min:2|max:10',
            'bio'           =>  'nullable|string|max:20',
            'gender'        =>  'nullable|integer|in:0,1,2',
            'phone'         =>  'nullable|phone',
            'email'         =>  'nullable|email',
            'intro'         =>  'nullable|string|max:300',
        ]);

        $user = $request->user();
        $data = $request->only(['nickname', 'bio', 'gender', 'phone', 'email', 'intro']);

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * 更新我的头像
     */
    public function mineAvatarUpdate(Request $request)
    {
        $request->validate([
            'file'      =>  'required|image',
        ]);

        // 小程序 内容安全检测
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkImage($request->file('file'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '图片涉及违规敏感信息',
            ], 403);
        }

        $user = $request->user();
        $filePath = $request->file('file')->store('uploads/users/avatars');
        $user->update(['avatar' => $filePath]);

        return new UserResource($user);
    }

    /**
     * 更新我的封面
     */
    public function mineCoverUpdate(Request $request)
    {
        $request->validate([
            'file'      =>  'required|image',
        ]);

        // 小程序 内容安全检测
        $app = app('wechat.mini_program');
        $result = $app->content_security->checkImage($request->file('file'));
        if ($result['errcode'] === 87014) {
            return response([
                'errcode'   =>  $result['errcode'],
                'errmsg'    =>  $result['errmsg'],
                'message'   =>  '图片涉及违规敏感信息',
            ], 403);
        }

        $user = $request->user();
        $filePath = $request->file('file')->store('uploads/users/cover');
        $user->update(['cover' => $filePath]);

        return new UserResource($user);
    }

    /**
     * 同步微信的用户资料
     */
    public function mineSyncWxProfile(Request $request)
    {
        $this->validate($request, [
            'nickName'      =>  'nullable|string',
            'gender'        =>  'nullable|integer',
            'avatarUrl'     =>  'nullable|string',
            'province'      =>  'nullable|string',
            'city'          =>  'nullable|string',
        ]);

        $user = $request->user();

        $data = ['wx_user_info' => $request->all()];
        if ($request->get('avatarUrl')) {
            $client = new Client();
            $avatarData = $client->request('get', $request->get('avatarUrl'))->getBody()->getContents();
            $avatarPath = 'uploads/users/avatars/' . Str::random(40) . '.jpg';
            Storage::put($avatarPath, $avatarData);
            $data['avatar'] = $avatarPath;
        }
        if ($request->get('nickName')) $data['nickname'] = $request->get('nickName');
        if ($request->get('gender')) $data['gender'] = $request->get('gender');

        if ($data) {
            $user->update($data);
        }

        return new UserResource($user);
    }
}
