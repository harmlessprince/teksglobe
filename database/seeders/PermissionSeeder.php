<?php

namespace Database\Seeders;

use Database\Factories\PermissonFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [ // role permission 
            'create role',
            'view role',
            'update role',
            'assign role',

            //payment
            'confirm payment',
            'decline payment',

            //package
            'create package',
            'update package',
            'delete package',


            //withrawal
            'confirm withdrawal',
            'decline withdrawal',

            //loan
            'confirm loan',
            'decline loan',

            //membership
            'confirm membership',
            'decline membership',
        ];
        foreach ($datas as  $data) {
           Permission::create(['name' => $data]);
        }
    }
}
