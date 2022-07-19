<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /**
     * @var string[]    User 模型结构
     */
    protected array $userModelStructure = [
        'id', 'nickname', 'avatar',
    ];

    /**
     * test 用户资料
     *
     * @return void
     */
    public function testGetUser()
    {
        $user = User::factory()->create();

        $this->getJson('api/users/' . $user->getAttribute('id'))
            ->assertOk()
            ->assertJsonStructure(['data' => $this->userModelStructure]);
    }
}
