<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'nickname'      =>      'Admin',
            'gender'        =>      1,
            'bio'           =>      'I\'m Admin',
            'phone'         =>      12312341234,
            'email'         =>      'admin@heycommunity.com',
            'password'      =>      Hash::make('hey community'),

            'last_active_at'    =>      $faker->dateTimeThisMonth(),
            'created_at'        =>      $faker->dateTimeThisMonth(),
            'updated_at'        =>      $faker->dateTimeThisMonth(),
        ]);

        User::factory()->count(50)->create();
    }
}
