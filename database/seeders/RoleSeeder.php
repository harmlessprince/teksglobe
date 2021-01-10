<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
      
        $users = User::all();

        $roles = SpatieRole::get();

      
        foreach ($users as  $user) {
            $role = $roles->pluck('name')->random();
            print_r($role);
            $user->assignRole( $role);
            // $user->removeRole('super admin');
        }

    }
}
