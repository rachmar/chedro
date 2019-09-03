<?php

use App\Model\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->description = 'An Admin';
        $admin->save();

        $manager = new Role();
        $manager->name = 'Manager';
        $manager->description = 'A Manager';
        $manager->save();

        $staff = new Role();
        $staff->name = 'Staff';
        $staff->description = 'A Staff';
        $staff->save();

        $customer = new Role();
        $customer->name = 'Customer';
        $customer->description = 'A Customer';
        $customer->save();
    }
}
