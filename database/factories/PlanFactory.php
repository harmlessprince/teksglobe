<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'style_id' => Style::all()->random()->id,
            // 'style_id' => Style::all()->plans()->get(),
            'plan_name' => $this->faker->colorName,
            'minimum' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'maximum' => $this->faker->numberBetween($min = 10000, $max = 20000),
            'percentage' => $this->faker->numberBetween($min = 20, $max = 70),
            'start_duration' => $this->faker->randomElement($array = array (1,24,168, 720, 8760)),
            'repeat' =>  $this->faker->numberBetween($min = 10, $max = 20),
            'status' =>  $this->faker->boolean(60),
        ];
    }
}
