<?php

namespace Modules\Post\Database\Seeders;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Article\Entities\Article;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostImage;

class PostDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        $faker->addProvider(new \SupGeekRod\FakerZh\ZhCnDataProvider($faker));

        $users = User::inRandomOrder()->limit(50)->get();
        if ($users->empty()) {
            $users = User::factory()->count(50)->create();
        }

        Post::factory()
            ->state(new Sequence(
                fn () => [
                    'user_id'   =>  $faker->randomElement($users),
                ],
            ))
            ->has(Comment::factory()
                ->state(new Sequence(
                    fn () => ['user_id' => $faker->randomElement($users)],
                ))->count($faker->numberBetween(3, 10))
            )
            ->has(Thumb::factory()
                ->state(new Sequence(
                    fn () => ['user_id' => $faker->randomElement($users)],
                ))->count($faker->numberBetween(3, 10))
            )
            ->count(50)
            ->create();
    }

    /**
     * 生成 Post 数据
     */
    protected function makePostData(\Faker\Generator $faker)
    {
        $data = [];

        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            $userId = $faker->randomElement($userIds);

            $data[] = [
                'user_id'       =>      $userId,
                'content'       =>      implode('', $faker->paragraphs(random_int(1, 6))),

                'status'        =>  1,
                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Post::insert($data);
    }

    /**
     * 生成 PostImage 数据
     */
    protected function makePostImageData(\Faker\Generator $faker)
    {
        $postImageData = [];
        $postIds = Post::pluck('id')->toArray();

        foreach ($postIds as $postId) {
            if (random_int(1, 10) <= 8) {
                foreach (range(1, random_int(1, 4)) as $index) {
                    $postImageData[] = [
                        'post_id'       =>  $postId,
                        'file_path'     =>  $faker->imageUrl(640, 480, true),
                    ];
                }
            }
        }

        PostImage::insert($postImageData);
    }

    /**
     * 生成 PostComment 数据
     */
    public function makePostCommentData(\Faker\Generator $faker)
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        foreach (range(1, count($postIds)) as $index) {
            $data[] = [
                'floor_number'  =>  1,

                'user_id'       =>  $faker->randomElement($userIds),
                'entity_class'  =>  Post::class,
                'entity_id'     =>  $faker->randomElement($postIds),

                'content'       =>  implode('', $faker->paragraphs(random_int(1, 3))),

                'status'        =>  1,
                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Comment::insert($data);
    }
}
