<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            
            'user_id' => User::factory()->create()->id,
            'mobile' => $this->faker->phoneNumber,
            'occupation' => $this->faker->jobTitle,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postcode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'about' => $this->faker->text,
            'facebook' => $this->faker->url,
            'avatar' => 'uploads/avatars/default.jpg',
        ];
    }
}
