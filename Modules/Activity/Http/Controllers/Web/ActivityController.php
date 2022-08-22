<?php

namespace Modules\Activity\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Activity\Entities\Activity;

class ActivityController extends Controller
{
    /**
     * 列表页
     */
    public function index()
    {
        $activities = Activity::latest()->paginate();

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
