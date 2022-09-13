<?php
namespace Modules\Post\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Entities\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Post\Entities\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       =>  null,
            'content'       =>  $this->faker->paragraphs(random_int(1, 6), true),

            'status'        =>  $this->faker->randomElement(array_keys(Post::$statuses)),
            'created_at'    =>  $this->faker->dateTimeThisMonth(),
            'updated_at'    =>  $this->faker->dateTimeThisMonth(),
        ];
    }
}

