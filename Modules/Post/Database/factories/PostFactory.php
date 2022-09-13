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

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $this->countingRelationNum($post);
        })->afterMaking(function (Post $post) {
            $this->countingRelationNum($post);
        });
    }

    /**
     * 计算关联模型数量
     */
    protected function countingRelationNum(Post $post)
    {
        $post->update([
            'thumb_up_num'      =>  $post->upThumbs()->count(),
            'thumb_down_num'    =>  $post->downThumbs()->count(),
            'comment_num'       =>  $post->comments()->count(),
        ]);
    }
}

