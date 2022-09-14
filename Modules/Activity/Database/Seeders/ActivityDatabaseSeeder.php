<?php

namespace Modules\Activity\Database\Seeders;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
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

        $users = User::inRandomOrder()->limit(20)->get();
        if ($users->isEmpty()) {
            $users = User::factory()->count(20)->create();
        }

        Activity::factory()
            ->state(new Sequence(
                fn () => [
                    'user_id'   =>  $faker->randomElement($users),
                ],
            ))
            ->count(20)
            ->create()
            ->each(function ($activity) use ($faker, $users) {
                if (random_int(0, 9) < 6) {
                    $activity->comments()->saveMany(Comment::factory()
                        ->state(new Sequence(fn () => ['user_id' => $faker->randomElement($users)]))
                        ->count(random_int(3, 10))->make());

                    $activity->thumbs()->saveMany(Thumb::factory()
                        ->state(new Sequence(fn () => ['user_id' => $faker->randomElement($users)]))
                        ->count(random_int(1, 20))->make());

                    $activity->update([
                        'thumb_up_num'      =>  $activity->upThumbs()->count(),
                        'thumb_down_num'    =>  $activity->downThumbs()->count(),
                        'comment_num'       =>  $activity->comments()->count(),
                    ]);
                }
            });
    }
}
