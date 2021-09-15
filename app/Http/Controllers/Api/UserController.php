<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post\Post;
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
        ]);

        $miniProgram = \EasyWeChat::miniProgram();
        $wxRes = $miniProgram->auth->session($request->code);

        if (isset($wxRes['openid'])) {
            $user = User::firstOrCreate(['wx_open_id' => $wxRes['openid']]);
            $user->update(['last_active_at' => now()]);

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
     * 用户发布的动态
     */
    public function posts(Request $request, User $user)
    {
        $posts = Post::where('status', '1')->where('user_id', $user->id)->latest()->paginate();

        return PostResource::collection($posts);
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
