<?php
namespace Modules\Article\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Article\Entities\Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       =>  User::factory(),

            'title'         =>  $this->faker->sentence(),
            'cover'         =>  $this->faker->imageUrl(480, 360, true),

            'intro'         =>  Str::limit($this->faker->paragraph, 200),
            'content'       =>  $this->faker->text(random_int(100, 500))
                                    . '<br><br>' . $this->faker->text(random_int(100, 500))
                                    . '<br><br>' . $this->faker->text(random_int(100, 500)),

            'author'        =>  $this->faker->name(),
            'published_at'  =>  $this->faker->dateTimeThisMonth(),

            'created_at'    =>  $this->faker->dateTimeThisMonth(),
            'updated_at'    =>  $this->faker->dateTimeThisMonth(),
        ];
    }
}

