<?php

namespace Database\Seeders;

use App\Models\Common\Comment;
use App\Models\Timeline\Timeline;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TimelineCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userIds = User::pluck('id')->toArray();
        $timelineIds = Timeline::pluck('id')->toArray();

        foreach (range(1, count($timelineIds)) as $index) {
            $data[] = [
                'floor_number'  =>  1,

                'user_id'       =>  $faker->randomElement($userIds),
                'entity_type'   =>  Timeline::class,
                'entity_id'     =>  $faker->randomElement($timelineIds),

                'content'       =>  implode('', $faker->paragraphs(random_int(1, 3))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Comment::insert($data);
    }
}
