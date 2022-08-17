<?php

namespace Modules\Article\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Modules\Article\Entities\Article;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use WithFaker;

    /**
     * @var string[]      Article 模型结构
     */
    protected array $articleModelStructure = [
        'id', 'user_id',
        'title', 'intro', 'content', 'cover', 'author',
        'is_topped', 'is_excellent', 'status', 'published_at'
    ];

    /**
     * test 获取文章列表
     *
     * @return void
     */
    public function testGetArticles()
    {
        $this->getJson(route('api.articles.index'))
            ->assertOk()
            ->assertJsonStructure(['data' => ['*' => $this->articleModelStructure]]);
    }

    /**
     * test 获取单个文章
     *
     * @return void
     */
    public function testGetArticle()
    {
        $this->getJson(route('api.articles.show', 1))
            ->assertOk()
            ->assertJsonStructure(['data' => $this->articleModelStructure]);
    }

    /**
     * test 点赞文章
     *
     * @return void
     */
    public function testThumbUpArticle()
    {
        Sanctum::actingAs(User::factory()->create());

        $article = Article::inRandomOrder()->first();

        // 点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Article::class,
            'entity_id'     =>  $article->getAttribute('id'),
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertCreated();

        // 重复点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Article::class,
            'entity_id'     =>  $article->getAttribute('id'),
            'type'          =>  'thumb_up',
            'value'         =>  true,
        ])->assertStatus(200);

        // 取消点赞
        $this->postJson('api/thumbs', [
            'entity_class'  =>  Article::class,
            'entity_id'     =>  $article->getAttribute('id'),
            'type'          =>  'thumb_up',
            'value'         =>  false,
        ])->assertStatus(202);

        // TODO: 测试 thumb_up_num 是否有增加
    }

    /**
     * test 评论文章
     *
     * @return array
     */
    public function testCommentArticle(): array
    {
        Sanctum::actingAs(User::factory()->create());

        $article = Article::inRandomOrder()->first();

        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Article::class,
            'entity_id'     =>  $article->getAttribute('id'),
            'content'       =>  'Test Comment',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$article, $response->json('data')];
    }

    /**
     * test 回复文章评论
     *
     * @depends testCommentArticle
     * @param $data
     * @return array
     */
    public function testReplyArticleComment($data): array
    {
        list($article, $comment) = $data;

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // 回复评论
        $response = $this->postJson('api/comments', [
            'entity_class'  =>  Article::class,
            'entity_id'     =>  $article->id,
            'parent_id'     =>  $comment['id'],
            'content'       =>  'Test Comment Reply',
        ]);
        $response->assertCreated();

        // TODO: 测试评论数是否有增加

        return [$user, $comment, $response->json('data')];
    }
}
