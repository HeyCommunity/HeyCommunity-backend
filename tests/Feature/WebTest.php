<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WebTest extends TestCase
{
    /**
     * Home routes
     */
    public function testHomeRoute()
    {
        $this->get(route('web.home'))->assertRedirect(route('web.posts.index'));
    }

    /**
     * Auth routes
     */
    public function testAuthRoutes()
    {
        $this->post(route('web.logout-handler'))->assertRedirect(route('web.home'));
        $this->get(route('web.login'))->assertOk();

        $userPhoneNumber = '199' . random_int(11111111, 99999999);
        $userPassword = 'HeyCommunity' .date('Y');
        $user = User::factory()->create([
            'phone'     =>  $userPhoneNumber,
            'password'  =>  Hash::make($userPassword),
        ]);

        $this->post(route('web.login-handler', [
            'phone'     =>  $userPhoneNumber,
            'password'  =>  $userPassword,
        ]))->assertRedirect(route('web.home'));
        $this->get(route('web.users.show', $user))->assertSeeText($user->nickname)->assertSeeText('登出');
    }

    /**
     * User routes
     */
    public function testUserRoutes()
    {
        if ($user = User::inRandomOrder()->first()) {
            $this->get(route('web.users.show', $user))->assertOk();
        } else {
            $this->get(route('web.users.show', 1))->assertNotFound();
        }
    }
}
