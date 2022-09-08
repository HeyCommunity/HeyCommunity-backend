<?php

namespace Modules\Activity\Database\Seeders;

use App\Models\Common\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
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
        $users = User::inRandomOrder()->limit(20)->get();
        if ($users->empty()) {
            $users = User::factory()->count(50)->create();
        }

        Activity::factory()
            ->state(new Sequence(
                fn () => ['user_id' => $faker->randomElement($users)],
            ))
            ->has(Comment::factory()
                ->state(new Sequence(
                    fn () => ['user_id' => $faker->randomElement($users)],
                ))->count($faker->numberBetween(3, 10))
            )
            ->count(20)
            ->create();
    }
}
