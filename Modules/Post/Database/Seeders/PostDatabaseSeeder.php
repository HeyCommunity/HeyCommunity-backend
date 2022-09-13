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
use Modules\Post\Entities\PostVideo;

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
            ->has(PostImage::factory()->count($faker->numberBetween(1, 9)), 'images')
            ->has(PostVideo::factory()->count($faker->numberBetween(0, 1)), 'video')
            ->count(50)
            ->create();
    }
}
