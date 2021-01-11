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
            PermissionSeeder::class,
            RoleSeeder::class,
            CreateAdmin::class,
            PackageSeeder::class,
            UserSeeder::class,
            StyleSeeder::class,
            PlanSeeder::class,
            
        ]);
    }
}
