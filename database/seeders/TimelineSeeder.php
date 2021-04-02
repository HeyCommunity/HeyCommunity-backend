<?php

namespace Database\Seeders;

use App\Models\Timeline\Timeline;
use App\Models\Timeline\TimelineImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TimelineSeeder extends Seeder
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

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Timeline::insert($data);

        $timelineImageData = [];
        $timelineIds = Timeline::pluck('id')->toArray();

        foreach ($timelineIds as $timelineId) {
            if (random_int(1, 10) <= 8) {
                foreach (range(1, random_int(1, 4)) as $index) {
                    $timelineImageData[] = [
                        'timeline_id'   =>  $timelineId,
                        'file_path'     =>  getImageFakerUrl(),
                    ];
                }
            }
        }

        TimelineImage::insert($timelineImageData);
    }
}
