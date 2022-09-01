<?php

namespace Modules\Activity\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Activity\Entities\Activity;
use Modules\Activity\Entities\ActivityMember;
use Modules\Activity\Transformers\ActivityResource;

class ActivityController extends Controller
{
    /**
     * 活动列表
     */
    public function index(Request $request)
    {
        $request->validate([
            'type'  =>  'nullable|string|in:active,expired',
        ]);

        $activityQuery = Activity::query();

        if ($request->type === 'expired') {
            $activityQuery->where('started_at', '<=', now())
                ->orderByDesc('started_at');
        } else {
            $activityQuery->where('started_at', '>=', now()->subDay())
                ->orderBy('started_at');
        }

        $activities = $activityQuery->paginate();

        return ActivityResource::collection($activities);
    }

    /**
     * 活动详情
     */
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    /**
     * 活动报名
     */
    public function register(Request $request, Activity $activity)
    {
        $user = $request->user();

        if (ActivityMember::where('activity_id', $activity->id)->where('user_id', $user->id)->exists()) {
            return response(['message' => '你已报名过此活动，不能重复报名'], 403);
        }

        $activityMember = new ActivityMember();
        $activityMember->user_id = $user->id;
        $activityMember->activity_id = $activity->id;
        $activityMember->status = 1;

        if ($activityMember->save()) {
            $activity->decrement('surplus_ticket_num');
        }

        return new ActivityResource($activity);
    }
}
