<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'admin' => $this->faker->boolean(50),
            'active' => $this->faker->boolean(50),
            'mobile' => $this->faker->phoneNumber,
            'avatar' => 'uploads/avatars/default.jpg',
            // 'pin' => substr(str_shuffle($permitted_chars), 0, 5),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
    
}
