<?php

namespace Modules\Activity\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Activity\Entities\Activity;
use Modules\Activity\Entities\ActivityMember;

class ActivityController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $activities = Activity::latest()->paginate();

        return view('activity::dashboard.activities.index', compact('activities'));
    }

    /**
     * 详情页
     */
    public function show(Activity $activity)
    {
        return view('activity::dashboard.activities.show', compact('activity'));
    }

    /**
     * 创建页
     */
    public function create()
    {
        $activity = new Activity();

        $activity->setAttribute('user_id', request()->user()->id);

        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('activity::dashboard.activities.create', compact(
            'activity', 'quillEditorConfig'
        ));
    }

    /**
     * 创建处理
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover'             =>  'required|image',
            'title'             =>  'required|string',
            'user_id'           =>  'required|integer',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
            'address_name'      =>  'required|string',
            'address_full'      =>  'required|string',
            'longitude'         =>  'required|string',
            'latitude'          =>  'required|string',
            'started_at'        =>  'required|date',
            'ended_at'          =>  'required|date',
            'total_ticket_num'  =>  'required|integer',
            'surplus_ticket_num'=>  'required|integer',
            'price'             =>  'required|integer',
        ]);

        $coverPath = $request->cover->store('uploads/activities/covers');

        Activity::create([
            'cover'             =>  $coverPath,
            'title'             =>  $request->get('title'),
            'user_id'           =>  $request->get('user_id'),
            'intro'             =>  $request->get('intro'),
            'content'           =>  $request->get('content'),
            'address_name'      =>  $request->get('address_name'),
            'address_full'      =>  $request->get('address_full'),
            'longitude'         =>  $request->get('longitude'),
            'latitude'          =>  $request->get('latitude'),
            'started_at'        =>  $request->get('started_at'),
            'ended_at'          =>  $request->get('ended_at'),
            'total_ticket_num'  =>  $request->get('total_ticket_num'),
            'surplus_ticket_num'=>  $request->get('surplus_ticket_num'),
            'price'             =>  $request->get('price'),
        ]);

        notify()->success('创建活动成功', '操作成功');
        return redirect()->route('dashboard.activities.index');
    }

    /**
     * 编辑页
     */
    public function edit(Activity $activity)
    {
        $quillEditorConfig = json_encode([
            'placeholder'   =>  '请输入',
        ]);

        return view('activity::dashboard.activities.edit', compact('activity', 'quillEditorConfig'));
    }

    /**
     * 更新处理
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'cover'             =>  'nullable|image',
            'title'             =>  'required|string',
            'user_id'           =>  'required|integer',
            'intro'             =>  'required|string',
            'content'           =>  'required|string',
            'address_name'      =>  'required|string',
            'address_full'      =>  'required|string',
            'longitude'         =>  'required|string',
            'latitude'          =>  'required|string',
            'started_at'        =>  'required|date',
            'ended_at'          =>  'required|date',
            'total_ticket_num'  =>  'required|integer',
            'surplus_ticket_num'=>  'required|integer',
            'price'             =>  'required|integer',
        ]);

        $data = [
            'title'             =>  $request->get('title'),
            'user_id'           =>  $request->get('user_id'),
            'intro'             =>  $request->get('intro'),
            'content'           =>  $request->get('content'),
            'address_name'      =>  $request->get('address_name'),
            'address_full'      =>  $request->get('address_full'),
            'longitude'         =>  $request->get('longitude'),
            'latitude'          =>  $request->get('latitude'),
            'started_at'        =>  $request->get('started_at'),
            'ended_at'          =>  $request->get('ended_at'),
            'total_ticket_num'  =>  $request->get('total_ticket_num'),
            'surplus_ticket_num'=>  $request->get('surplus_ticket_num'),
            'price'             =>  $request->get('price'),
        ];

        if ($request->has('cover')) {
            $coverPath = $request->cover->store('uploads/activities/covers');
            $data['cover'] = $coverPath;
        }

        $activity->update($data);

        notify()->success('更新活动成功', '操作成功');
        return redirect()->route('dashboard.activities.index');
    }
}
