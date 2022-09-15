<?php
namespace Modules\Post\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Entities\Post;

class PostImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Post\Entities\PostImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'       =>  null,
            'user_id'       =>  function (array $attributes) {
                return Post::select('user_id')->find($attributes['post_id'])->user_id;
            },
            'file_path'     =>  $this->faker->imageUrl(640, 480, true),
        ];
    }
}

