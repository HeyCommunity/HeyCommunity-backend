<?php

namespace Modules\Activity\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Activity\Entities\Activity;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Activity\Entities\Activity::class;

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
            'cover'         =>  $this->faker->imageUrl(800, 600, true),
            'intro'         =>  $this->faker->sentences(2, true),
            'content'       =>  $this->faker->paragraphs(random_int(5, 20), true),

            'address_name'  =>  $this->faker->streetName(),
            'address_full'  =>  $this->faker->address(),
            'latitude'      =>  $this->faker->latitude(),
            'longitude'     =>  $this->faker->longitude(),
            'started_at'    =>  $this->faker->dateTimeThisMonth(),
            'ended_at'      =>  $this->faker->dateTimeThisMonth(),

            'price'                 =>  $this->faker->randomElement([0, 10, 20, 30, 50, 100]),
            'total_ticket_num'      =>  $this->faker->randomElement([10, 20, 50]),
            'surplus_ticket_num'    =>  fn (array $attributes) => $attributes['total_ticket_num'],

            'status'        =>  $this->faker->randomElement(array_keys(Activity::$statuses)),
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
        return $this->afterCreating(function (Activity $activity) {
            $this->countingRelationNum($activity);
        })->afterMaking(function (Activity $activity) {
            $this->countingRelationNum($activity);
        });
    }

    /**
     * 计算关联模型数量
     */
    protected function countingRelationNum(Activity $activity)
    {
        $activity->update([
            'thumb_up_num'      =>  $activity->upThumbs()->count(),
            'thumb_down_num'    =>  $activity->downThumbs()->count(),
            'comment_num'       =>  $activity->comments()->count(),
        ]);
    }
}

