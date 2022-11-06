<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userPhone = '19912341234';
        $userEmail = 'admin@heycommunity.com';
        $userPassword = Hash::make('HeyCommunity');

        if (! User::where(['phone' => $userPhone, 'email' => $userEmail])->exists()) {
            User::create([
                'avatar'        =>      'images/heycommunity/logo.png',
                'nickname'      =>      'Admin',
                'gender'        =>      1,
                'bio'           =>      'I\'m Admin',
                'phone'         =>      $userPhone,
                'email'         =>      $userEmail,
                'password'      =>      $userPassword,

                'last_active_at'    =>      $faker->dateTimeThisMonth(),
                'created_at'        =>      $faker->dateTimeThisMonth(),
                'updated_at'        =>      $faker->dateTimeThisMonth(),
            ]);
        }
    }
}
