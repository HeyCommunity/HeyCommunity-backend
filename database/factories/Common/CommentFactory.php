<?php

namespace Database\Factories\Common;

use App\Models\Common\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'floor_number'  =>  1,

            'user_id'       =>  null,
            'entity_class'  =>  null,
            'entity_id'     =>  null,
            'content'       =>  $this->faker->sentences(random_int(1, 3),true),
            'status'        =>  1,
        ];
    }
}
