<?php

namespace Database\Factories;

use App\Models\Withdraw;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Withdraw::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'charge' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'admin' => $this->faker->boolean(50),
            'active' => $this->faker->boolean(50),
            'mobile' => $this->faker->phoneNumber,
        ];
    }
}
