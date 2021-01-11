<?php

namespace Database\Seeders;

use App\Models\Investment;
use App\Models\Profile;
use App\Models\User;
use Database\Factories\ProfileFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        User::factory(10)->create()->each(function ($user) {
            $user->investments()->saveMany(Investment::factory(3)->make(['user_id' => null]));
        });
    }
}
