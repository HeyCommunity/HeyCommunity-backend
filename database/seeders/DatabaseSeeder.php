<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Post\Database\Seeders\PostDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        $faker->addProvider(new \SupGeekRod\FakerZh\ZhCnDataProvider($faker));

        $this->call(UserSeeder::class);
        $this->call(PostDatabaseSeeder::class);
    }
}
