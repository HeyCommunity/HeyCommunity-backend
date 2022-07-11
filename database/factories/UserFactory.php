<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create(config('app.faker_locale'));
        $this->faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($this->faker));
        $this->faker->addProvider(new \SupGeekRod\FakerZh\ZhCnDataProvider($this->faker));

        return [
            'nickname'      =>      $this->faker->name(),
            'avatar'        =>      $this->faker->imageUrl(640, 640, true),
            'gender'        =>      $this->faker->randomElement([1, 2]),
            'bio'           =>      $this->faker->sentence(),
            'intro'         =>      $this->faker->sentences(random_int(2, 5), true),
            'phone'         =>      $this->faker->phoneNumber(),
            'email'         =>      $this->faker->email(),
            'cover'         =>      $this->faker->imageUrl(1528, 675, true),
            'password'      =>      Hash::make('HeyCommunity'),

            'last_active_at'    =>      $this->faker->dateTimeThisMonth(),
            'created_at'        =>      $this->faker->dateTimeThisMonth(),
            'updated_at'        =>      $this->faker->dateTimeThisMonth(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
