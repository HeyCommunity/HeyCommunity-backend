<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $communities = Community::latest()->paginate();

        return view('dashboard.communities.index', compact('communities'));
    }

    /**
     * 详情页
     */
    public function show(Community $community)
    {
        return view('dashboard.communities.show', compact('community'));
    }

    /**
     * 创建页
     */
    public function create()
    {
        $community = new Community();

        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('dashboard.communities.create', compact('community', 'quillEditorConfig'));
    }

    /**
     * 创建处理
     */
    public function store(Request $request)
    {
        $request->validate([
            'app_id'            =>  'required|string',
            'authorizer_id'     =>  'nullable|integer',
            'name'              =>  'required|string',
            'avatar'            =>  'required|string',
            'slogan'            =>  'required|string',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
        ]);

        Community::create([
            'app_id'        =>  $request->get('app_id'),
            'authorizer_id' =>  $request->get('authorizer_id'),
            'name'          =>  $request->get('name'),
            'avatar'        =>  $request->get('avatar'),
            'slogan'        =>  $request->get('slogan'),
            'intro'         =>  $request->get('intro'),
            'content'       =>  $request->get('content'),
        ]);

        notify()->success('新增社区成功', '操作成功');
        return redirect()->route('dashboard.communities.index');
    }

    /**
     * 编辑页
     */
    public function edit(Community $community)
    {
        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('dashboard.communities.edit', compact('community', 'quillEditorConfig'));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, Community $community)
    {
        $request->validate([
            'app_id'            =>  'required|string',
            'authorizer_id'     =>  'nullable|integer',
            'name'              =>  'required|string',
            'avatar'            =>  'required|string',
            'slogan'            =>  'required|string',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
        ]);

        $data = [
            'name'          =>  $request->get('name'),
            'avatar'        =>  $request->get('avatar'),
            'slogan'        =>  $request->get('slogan'),
            'intro'         =>  $request->get('intro'),
            'content'       =>  $request->get('content'),
        ];
        if ($request->has('app_id')) $data['app_id'] = $request->get('app_id');
        if ($request->has('authorizer_id')) $data['authorizer_id'] = $request->get('authorizer_id');

        $community->update($data);

        notify()->success('更新社区成功', '操作成功');
        return redirect()->route('dashboard.communities.index');
    }
}
