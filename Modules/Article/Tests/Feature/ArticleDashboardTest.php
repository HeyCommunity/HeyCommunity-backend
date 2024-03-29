<?php

namespace Modules\Article\Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Article\Entities\Article;
use Tests\TestCase;

class ArticleDashboardTest extends TestCase
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
        $article = Article::inRandomOrder()->first();

        $this->get(route('dashboard.articles.index'))->assertUnauthorized();
        $this->get(route('dashboard.articles.show', ($article ?? '1')))->assertUnauthorized();

        $this->loginAndSetAdmin($user);

        $this->get(route('dashboard.articles.index'))->assertOk();
        if ($article) {
            $this->get(route('dashboard.articles.show', $article))->assertOk();
        } else {
            $this->get(route('dashboard.articles.show', 1))->assertNotFound();
        }
    }
}
