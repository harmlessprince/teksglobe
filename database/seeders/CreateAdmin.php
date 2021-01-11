<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'admin' => true,
            'active' => true,
            'mobile' => '09098393003',
            'avatar' => 'uploads/avatars/default.jpg',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $adminUser = User::firstWhere('name', 'Super Admin');
        $adminRole = SpatieRole::firstWhere('name', 'Super Admin');

        $adminRole->syncPermissions(Permission::all());
        $adminUser->assignRole($adminRole);
    }
}
