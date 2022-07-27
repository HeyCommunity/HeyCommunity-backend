<?php

namespace Database\Factories\Common;

use App\Models\Common\Thumb;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThumbFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thumb::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create(config('app.faker_locale'));
        $this->faker->addProvider(new \SupGeekRod\FakerZh\ZhCnDataProvider($this->faker));

        return [
            'type'              =>  'thumb_up',
            'user_id'           =>  null,
            'entity_class'      =>  null,
            'entity_id'         =>  null,

            'created_at'        =>  $this->faker->dateTimeThisMonth(),
            'updated_at'        =>  $this->faker->dateTimeThisMonth(),
        ];
    }
}
