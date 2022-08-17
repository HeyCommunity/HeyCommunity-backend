<?php

namespace Modules\Activity\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Modules\Activity\Entities\Activity;
use Tests\TestCase;

class ActivityApiTest extends TestCase
{
    use WithFaker;

    /**
     * @var string[]      Activity 模型结构
     */
    protected array $activityModelStructure = [
        'id', 'user_id', 'title', 'cover', 'intro', 'content',
        'address_name', 'address_full', 'latitude', 'longitude',
        'started_at', 'ended_at', 'price',
        'total_ticket_num', 'surplus_ticket_num',
        'thumb_up_num', 'comment_num',
    ];

    /**
     * test 获取活动列表
     *
     * @return void
     */
    public function testGetActivities()
    {
        $this->getJson(route('api.activities.index'))
            ->assertOk()
            ->assertJsonStructure(['data' => ['*' => $this->activityModelStructure]]);
    }

    /**
     * test 获取单个活动
     *
     * @return void
     */
    public function testGetActivity()
    {
        $this->getJson(route('api.activities.show', 1))
            ->assertOk()
            ->assertJsonStructure(['data' => $this->activityModelStructure]);
    }

    /**
     * test 点赞活动
     *
     * @return void
     */
    public function testThumbUpActivity()
    {
        Sanctum::actingAs(User::factory()->create());

        $activity = Activity::inRandomOrder()->first();

        // 点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Activity::class,
            'entity_id'     =>  $activity->id,
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertCreated();

        // 重复点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Activity::class,
            'entity_id'     =>  $activity->id,
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertStatus(200);

        // 取消点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Activity::class,
            'entity_id'     =>  $activity->id,
            'type'          =>  'thumb_up',
            'value'         =>  false,
        ])->assertStatus(202);

        // TODO: 测试 thumb_up_num 是否有增加
    }

    /**
     * test 评论活动
     *
     * @return array
     */
    public function testCommentActivity(): array
    {
        Sanctum::actingAs(User::factory()->create());

        $activity = Activity::inRandomOrder()->first();

        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Activity::class,
            'entity_id'     =>  $activity->id,
            'content'       =>  'Test Comment',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$activity, $response->json('data')];
    }

    /**
     * test 回复动态评论
     *
     * @depends testCommentActivity
     * @param $data
     * @return array
     */
    public function testReplyActivityComment($data): array
    {
        list($activity, $comment) = $data;

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // 回复评论
        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Activity::class,
            'entity_id'     =>  $activity->id,
            'parent_id'     =>  $comment['id'],
            'content'       =>  'Test Comment Reply',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$user, $comment, $response->json('data')];
    }
}
