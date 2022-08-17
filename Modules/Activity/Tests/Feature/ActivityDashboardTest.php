<?php

namespace Modules\Activity\Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Activity\Entities\Activity;
use Tests\TestCase;

class ActivityDashboardTest extends TestCase
{
    /**
     * 创建用户
     */
    public function testCreateUser()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        $this->assertModelExists($user);

        return $user;
    }

    /**
     * 接收一个 User，并对其进行登入和设置为 Admin
     */
    public function loginAndSetAdmin($user)
    {
        Auth::guard('web')->login($user);
        config()->set('heycommunity.dashboard.admin_ids', [$user->id]);
    }

    /**
     * Dashboard activity routes
     *
     * @depends testCreateUser
     */
    public function testDashboardActivityRoutes($user)
    {
        dd(route('dashboard.activities.index'));

        $activity = Activity::inRandomOrder()->first();

        $this->get(route('dashboard.activities.index'))->assertUnauthorized();
        $this->get(route('dashboard.activities.show', ($activity ?? '1')))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.activities.index'))->assertOk();
        if ($activity) {
            $this->get(route('dashboard.activities.show', $activity))->assertOk();
        } else {
            $this->get(route('dashboard.activities.show', 1))->assertNotFound();
        }
    }
}
