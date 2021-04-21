<?php

namespace Database\Seeders;

use App\Models\Common\Comment;
use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        foreach (range(1, count($postIds)) as $index) {
            $data[] = [
                'floor_number'  =>  1,

                'user_id'       =>  $faker->randomElement($userIds),
                'entity_type'   =>  Post::class,
                'entity_id'     =>  $faker->randomElement($postIds),

                'content'       =>  implode('', $faker->paragraphs(random_int(1, 3))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Comment::insert($data);
    }
}
