<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use App\Models\Post\PostImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
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

        $postImageData = [];
        $postIds = Post::pluck('id')->toArray();

        foreach ($postIds as $postId) {
            if (random_int(1, 10) <= 8) {
                foreach (range(1, random_int(1, 4)) as $index) {
                    $postImageData[] = [
                        'post_id'   =>  $postId,
                        'file_path'     =>  getImageFakerUrl(),
                    ];
                }
            }
        }

        PostImage::insert($postImageData);
    }
}
