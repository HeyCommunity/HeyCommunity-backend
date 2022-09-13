<?php
namespace Modules\Post\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Entities\Post;

class PostVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Post\Entities\PostVideo::class;

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
            'file_path'     =>  $this->faker->randomElement([
                'https://www.w3school.com.cn/i/movie.ogg',
                'https://www.runoob.com/try/demo_source/mov_bbb.mp4',
                'https://www.runoob.com/try/demo_source/movie.mp4',
                'http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',
                'http://vjs.zencdn.net/v/oceans.mp4',
            ]),
        ];
    }
}

