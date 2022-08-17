<?php

namespace Modules\Activity\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Entities\Activity;

class ActivityDatabaseSeeder extends Seeder
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

        $this->makeActivities($faker);
    }

    /**
     * 创建活动
     */
    protected function makeActivities(\Faker\Generator $faker)
    {
        $userIds = User::pluck('id')->toArray();

        $data = [];
        foreach (range(1, 20) as $index) {
            $totalTicketNum = $faker->randomElement([10, 20, 50]);

            $data[$index] = [
                'user_id'   =>  $faker->randomElement($userIds),
                'title'     =>  $faker->sentence(),
                'cover'     =>  $faker->imageUrl(800, 600, true),
                'intro'     =>  $faker->sentences(2, true),
                'content'   =>  $faker->paragraphs(random_int(5, 20), true),

                'address_name'  =>  $faker->streetName(),
                'address_full'  =>  $faker->address(),
                'latitude'      =>  $faker->latitude(),
                'longitude'     =>  $faker->longitude(),
                'started_at'    =>  $faker->dateTimeThisMonth(),
                'ended_at'      =>  $faker->dateTimeThisMonth(),

                'price'                 =>  $faker->randomElement([0, 10, 20, 30, 50, 100]),
                'total_ticket_num'      =>  $totalTicketNum,
                'surplus_ticket_num'    =>  $totalTicketNum,
            ];
        }

        Activity::insert($data);
    }
}
