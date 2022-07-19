<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Modules\Post\Entities\Post;
use SupGeekRod\FakerZh\ZhCnDataProvider;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithFaker;

    /**
     * @var string[]      Post 模型结构
     */
    protected array $postModelStructure = [
        'id', 'content', 'images', 'video',
        'user_id', 'user_nickname', 'user_avatar',
        'i_have_thumb_up', 'i_have_comment'
    ];

    /**
     * test 创建动态
     *
     * @return array    返回创建的动态
     */
    public function testCreatePost(): array
    {
        Sanctum::actingAs(User::factory()->create());

        $faker = $this->faker();

        // TODO: test 上传图片
        // TODO: test 上传视频
        $response = $this->postJson('api/posts', [
            'content'       =>  $faker->text(1000),
        ]);

        $response->assertCreated()->assertJsonStructure(['data' => $this->postModelStructure]);

        return $response->json('data');
    }

    /**
     * test 获取动态
     *
     * @depends testCreatePost
     * @return void
     */
    public function testGetPosts()
    {
        $response = $this->getJson('api/posts');

        $response->assertOk()->assertJsonStructure(['data' => ['*' => $this->postModelStructure]]);
    }

    /**
     * test 获取单个动态
     *
     * @depends testCreatePost
     * @return void
     */
    public function testGetPost($post)
    {
        $response = $this->getJson('api/posts/' . $post['id']);

        $response->assertOk()->assertJsonStructure(['data' => $this->postModelStructure]);
    }

    /**
     * test 点赞动态
     *
     * @depends testCreatePost
     * @return void
     */
    public function testThumbUpPost($post)
    {
        Sanctum::actingAs(User::factory()->create());

        // TODO: 测试动态的 thumb_up_num 是否有增加

        // 点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Post::class,
            'entity_id'     =>  $post['id'],
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertCreated();

        // 重复点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Post::class,
            'entity_id'     =>  $post['id'],
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertStatus(200);

        // 取消点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Post::class,
            'entity_id'     =>  $post['id'],
            'type'          =>  'thumb_up',
            'value'         =>  false,
        ])->assertStatus(202);
    }

    /**
     * test 评论动态
     *
     * @depends testCreatePost
     * @param $post
     * @return array
     */
    public function testCommentPost($post): array
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Post::class,
            'entity_id'     =>  $post['id'],
            'content'       =>  'Test Comment',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$post, $response->json('data')];
    }

    /**
     * test 回复动态评论
     *
     * @depends testCommentPost
     * @param $data
     * @return array
     */
    public function testReplyPostComment($data): array
    {
        list($post, $comment) = $data;

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // 回复评论
        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Post::class,
            'entity_id'     =>  $post['id'],
            'parent_id'     =>  $comment['id'],
            'content'       =>  'Test Comment Reply',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$user, $comment, $response->json('data')];
    }

    /**
     * test 删除动态的评论和回复
     *
     * @depends testReplyPostComment
     * @return void
     */
    public function testDestroyPostComment($data)
    {
        list($user, $comment, $subComment) = $data;
        Sanctum::actingAs($user);

        // 删除评论
        $this->postJson('api/comments/delete', [
            'id'        =>  $comment['id'],
        ])->assertForbidden();

        // 删除子评论
        $this->postJson('api/comments/delete', [
            'id'        =>  $subComment['id'],
        ])->assertStatus(202);
    }
}
