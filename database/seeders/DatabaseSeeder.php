<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // PackageSeeder::class,
            UserSeeder::class,
            // ProfileSeeder::class,
            // StyleSeeder::class,
            // PlanSeeder::class,
        ]);
    }
}
