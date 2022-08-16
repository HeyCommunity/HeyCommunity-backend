<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Modules\Post\Entities\Post;

class FeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feed::class;

    public function __construct(
        $count = null,
        ?Collection $states = null,
        ?Collection $has = null,
        ?Collection $for = null,
        ?Collection $afterMaking = null,
        ?Collection $afterCreating = null,
        $connection = null
    ) {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);

        $this->entities = $this->getEntities();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entity = $this->faker->randomElement($this->entities);

        return [
            'entity_id'         =>  $entity->id,
            'entity_class'      =>  get_class($entity),
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
