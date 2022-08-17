<?php

namespace Modules\Post\Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Post\Entities\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostDashboardTest extends TestCase
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
     * Dashboard post routes
     *
     * @depends testCreateUser
     */
    public function testDashboardPostRoutes($user)
    {
        dd(route('dashboard.posts.index'));

        $post = Post::inRandomOrder()->first();

        $this->get(route('dashboard.posts.index'))->assertUnauthorized();
        $this->get(route('dashboard.posts.show', ($post ?? '1')))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.posts.index'))->assertOk();
        if ($post) {
            $this->get(route('dashboard.posts.show', $post))->assertOk();
        } else {
            $this->get(route('dashboard.posts.show', 1))->assertNotFound();
        }
    }
}
