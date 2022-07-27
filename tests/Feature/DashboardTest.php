<?php

namespace Tests\Feature;

use App\Models\Common\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardTest extends TestCase
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
     * Dashboard index route
     *
     * @depends testCreateUser
     */
    public function testDashboardIndexRoute($user)
    {
        $this->get(route('dashboard.index'))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.index'))->assertOk();
    }

    /**
     * Dashboard analytics routes
     *
     * @depends testCreateUser
     */
    public function testDashboardAnalyticsRoutes($user)
    {
        $this->get(route('dashboard.analytics.index'))->assertUnauthorized();
        $this->get(route('dashboard.analytics.users'))->assertUnauthorized();
        $this->get(route('dashboard.analytics.visitor-logs'))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.analytics.index'))->assertRedirect(route('dashboard.analytics.users'));
        $this->get(route('dashboard.analytics.users'))->assertOk();
        $this->get(route('dashboard.analytics.visitor-logs'))->assertOk();
    }

    /**
     * Dashboard visitor-log routes
     *
     * @depends testCreateUser
     */
    public function testDashboardVisitorLogRoutes($user)
    {
        $this->get(route('dashboard.visitor-logs.index'))->assertUnauthorized();
        $this->get(route('dashboard.visitor-logs.analytics'))->assertUnauthorized();
        $this->get(route('dashboard.visitor-logs.date'))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.visitor-logs.index'))->assertOk();
        $this->get(route('dashboard.visitor-logs.analytics'))->assertOk();
        $this->get(route('dashboard.visitor-logs.date'))->assertRedirect(route('dashboard.visitor-logs.date', ['date' => date('Y-m-d')]));
    }

    /**
     * Dashboard thumb routes
     *
     * @depends testCreateUser
     */
    public function testDashboardThumbRoutes($user)
    {
        $this->get(route('dashboard.thumbs.index'))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.thumbs.index'))->assertOk();
    }

    /**
     * Dashboard comment routes
     *
     * @depends testCreateUser
     */
    public function testDashboardCommentRoutes($user)
    {
        $comment = Comment::first();

        $this->get(route('dashboard.comments.index'))->assertUnauthorized();
        if ($comment) {
            $this->get(route('dashboard.comments.show', $comment))->assertUnauthorized();
        }

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.comments.index'))->assertOk();
        if ($comment) {
            $this->get(route('dashboard.comments.show', $comment))->assertOk();
        }
    }

    /**
     * Dashboard user routes
     *
     * @depends testCreateUser
     */
    public function testDashboardUserRoutes($user)
    {
        $this->get(route('dashboard.users.index'))->assertUnauthorized();
        $this->get(route('dashboard.users.show', $user))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.users.index'))->assertOk();
        $this->get(route('dashboard.users.show', $user))->assertOk();
    }

    /**
     * Dashboard other routes
     *
     * @depends testCreateUser
     */
    public function testDashboardOtherRoutes($user)
    {
        $this->get(route('dashboard.iframes.telescope'))->assertUnauthorized();
        $this->get(route('log-viewer::dashboard'))->assertUnauthorized();
        $this->get(route('dashboard.iframes.log-viewer'))->assertUnauthorized();

        if (config('telescope.enabled')) {
            $this->get('dashboard/telescope/requests')->assertUnauthorized();
        } else {
            $this->get('dashboard/telescope/requests')->assertNotFound();
        }

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.iframes.telescope'))->assertOk();
        $this->get(route('log-viewer::dashboard'))->assertOk();
        $this->get(route('dashboard.iframes.log-viewer'))->assertOk();

        if (config('telescope.enabled')) {
            $this->get('dashboard/telescope/requests')->assertOk();
        }
    }
}
