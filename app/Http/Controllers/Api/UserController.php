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
     * 微信小程序用户 Signup
     *
     * 打开小程序后请求此 API，用于追踪用户访问
     * 如果未注册，则进行初步注册: status = 0
     */
    public function wxappSignup(Request $request)
    {
        $request->validate([
            'code'      =>  'required|string',
        ]);

        $miniProgram = \EasyWeChat::miniProgram();
        $wxRes = $miniProgram->auth->session($request->code);

        if (isset($wxRes['openid'])) {
            $user = User::firstOrCreate([
                'wx_open_id'        =>  $wxRes['openid'],
            ], [
                'last_active_at'    =>  now(),
            ]);
            $user->token = $user->createToken('token')->plainTextToken;

            Log::channel('hc')->info('[wxappUserSignup-success] 操作成功', ['wxRes' => $wxRes, 'user' => $user->getAttributes(), 'headers' => $request->server]);
            return new UserResource($user);
        } else {
            Log::channel('hc')->warning('[wxappUserSignup-fail] 操作失败', ['wxRes' => $wxRes, 'headers' => $request->server]);
            return response()->json(['message' => $wxRes['errmsg']], 500);
        }
    }

    /**
     * 微信小程序恢复登录
     */
    public function wxappRestoreLogin(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    /**
     * 微信小程序用户登录
     */
    public function wxappLogin(Request $request)
    {
        $request->validate([
            'code'      =>  'required|string',
            'user_info' =>  'required|array',
        ]);

        $miniProgram = \EasyWeChat::miniProgram();
        $wxRes = $miniProgram->auth->session($request->code);

        if (isset($wxRes['openid'])) {
            $user = User::firstOrCreate(['wx_open_id' => $wxRes['openid']]);

            // 更新用户资料
            if ($user->status === 0) {
                $wxUserInfo = $request->get('user_info');

                // 把用户头像保存在本地
                $client = new Client();
                $avatarData = $client->request('get', $wxUserInfo['avatarUrl'])->getBody()->getContents();
                $avatarPath = 'uploads/users/avatars/' . Str::random(40) . '.jpg';
                Storage::put($avatarPath, $avatarData);

                $user->update([
                    'nickname'  =>  $wxUserInfo['nickName'],
                    'gender'    =>  $wxUserInfo['gender'],
                    'avatar'    =>  $avatarPath,

                    'wx_user_info'  =>  $wxUserInfo,
                    'status'    =>  1,
                ]);
            }

            $user->token = $user->createToken('token')->plainTextToken;

            Log::channel('hc')->info('[wxappUserLogin-success] 用户登录成功', ['wxRes' => $wxRes, 'user' => $user->getAttributes(), 'headers' => $request->server]);
            return new UserResource($user);
        } else {
            Log::channel('hc')->warning('[wxappUserLogin-fail] 用户登录失败', ['wxRes' => $wxRes, 'headers' => $request->server]);
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
