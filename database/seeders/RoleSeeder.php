<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            'Super Admin',
            'Activate Package',
            'Activate Loan',
            'Activate Withdrawal',
        ];

        foreach ($roles as  $role) {
            SpatieRole::create(['name' => $role]);
        }

        // $users = User::where('name', '!=', 'Super Admin')->where('admin', true)->get();
        // foreach ($users as  $user) {
        //     $role = SpatieRole::where('name', '!=', 'Super Admin')->pluck('name');
           
        //     $user->assignRole($role->random());
        //     // $user->removeRole('super admin');
        // }
    }
}
