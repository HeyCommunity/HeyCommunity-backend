<?php

namespace Modules\Activity\Http\Controllers\Web;

use Modules\Activity\Entities\Activity;
use Modules\Activity\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $activities = Activity::latest()->paginate(12);

        return view('activity::web.index', compact('activities'));
    }

    /**
     * 详情页
     */
    public function show(Activity $activity)
    {
        return view('activity::web.show', compact('activity'));
    }
}
