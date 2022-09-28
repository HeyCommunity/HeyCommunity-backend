<?php

namespace Database\Factories;

use App\Models\Carousel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarouselFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sort'          =>  null,
            'type'          =>  $this->faker->randomElement(['web', 'wxapp']),

            'title'         =>  $this->faker->sentence(),
            'content'       =>  $this->faker->paragraph(),
            'image_path'    =>  $this->faker->imageUrl(480, 360, true),
            'link'          =>  function (array $attributes) {
                if ($attributes['type'] === 'wxapp') {
                    return $this->faker->randomElement([
                        '/modules/system/pages/heycommunity/index',
                        '/modules/user/pages/auth/index',
                    ]);
                }

                return $this->faker->randomElement([
                    'https://www.heycommunity.com',
                    'https://demo.heycommunity.com'
                ]);
            },

            'status'        =>  $this->faker->randomElement(array_keys(Carousel::$statuses)),

            'expired_at'    =>  $this->faker->dateTimeThisMonth(),
            'created_at'    =>  $this->faker->dateTimeThisMonth(),
            'updated_at'    =>  $this->faker->dateTimeThisMonth(),
        ];
    }
}
