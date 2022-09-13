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
            ->count(50)
            ->create()
            ->each(function ($post) use ($faker, $users) {
                if (random_int(0, 9) < 6) {
                    $post->comments()->saveMany(Comment::factory()
                        ->state(new Sequence(fn () => ['user_id' => $faker->randomElement($users)]))
                        ->count(random_int(3, 10))->make());

                    $post->thumbs()->saveMany(Thumb::factory()
                        ->state(new Sequence(fn () => ['user_id' => $faker->randomElement($users)]))
                        ->count(random_int(1, 20))->make());

                    $post->update([
                        'thumb_up_num'      =>  $post->upThumbs()->count(),
                        'thumb_down_num'    =>  $post->downThumbs()->count(),
                        'comment_num'       =>  $post->comments()->count(),
                    ]);
                }

                if (random_int(0, 9) < 3) {
                    $post->video()->saveMany(PostVideo::factory()->count(1)->make([
                        'post_id'       =>  $post->id,
                        'user_id'       =>  $post->user_id,
                    ]));
                } else {
                    $post->images()->saveMany(PostImage::factory()->count(random_int(1, 9))->make([
                        'post_id'       =>  $post->id,
                        'user_id'       =>  $post->user_id,
                    ]));
                }
            });
    }
}
