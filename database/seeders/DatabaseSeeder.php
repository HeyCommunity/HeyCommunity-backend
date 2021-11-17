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
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PostDatabaseSeeder::class);
    }
}
