<?php
namespace Modules\Activity\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Activity\Entities\ActivityMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       =>  null,
            'activity_id'   =>  null,

            'status'        =>  1,

            'created_at'    =>  $this->faker->dateTimeThisMonth(),
            'updated_at'    =>  $this->faker->dateTimeThisMonth(),
        ];
    }
}

