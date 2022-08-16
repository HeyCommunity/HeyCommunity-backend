<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Entities\Post;

class FeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entities = $this->getEntities();

        return [
            'entity_id'         =>  $this->faker->randomElement($entities)->id,
            'entity_class'      =>  get_class($this->faker->randomElement($entities)),
        ];
    }

    protected function getEntities()
    {
        $entities = collect();

        foreach ([
            '\Modules\Post\Entities\Post',
            '\Modules\Article\Entities\Article',
            '\Modules\Activity\Entities\Activity',
        ] as $modelClass) {
            if (class_exists($modelClass)) {
                $entities = $entities->concat((function ($modelClass) {
                    $model = new $modelClass;
                    return $model->inRandomOrder()->limit(10)->get();
                })($modelClass));
            }
        }

        return $entities;
    }
}
