<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'returns' => round($this->faker->numberBetween(50000, 100000), 5),
            'amount' => round($this->faker->numberBetween(10000, 50000), 5),
        ];
    }
}
