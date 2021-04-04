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

            'created_at'    =>      $faker->dateTimeThisMonth(),
            'updated_at'    =>      $faker->dateTimeThisMonth(),
        ]);

        $data = [];

        foreach (range(1, 50) as $index) {
            $avatarUrl = getImageFakerUrl(00, 300, 'people');
            $profileBgImgUrl = getImageFakerUrl(1528, 675);

            $data[] = [
                'nickname'      =>      $faker->name(),
                'avatar'        =>      $avatarUrl,
                'gender'        =>      1,
                'bio'           =>      $faker->catchPhrase(),
                'phone'         =>      $faker->phoneNumber(),
                'email'         =>      $faker->email(),
                'cover'         =>      $profileBgImgUrl,
                'password'      =>      Hash::make('hey community'),

                'created_at'    =>      $faker->dateTimeThisMonth(),
                'updated_at'    =>      $faker->dateTimeThisMonth(),
            ];
        }

        User::insert($data);
    }
}
