<?php

use App\User;
use App\Model\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_roles')->truncate();

        $role_admin    = Role::where('name', 'Admin')->first();
        $role_manager  = Role::where('name', 'Manager')->first();
        $role_staff    = Role::where('name', 'Staff')->first();
        $role_customer = Role::where('name', 'Customer')->first();

        $admin = new User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@chedro.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $manager = new User();
        $manager->name = 'Manager Manager';
        $manager->email = 'manager@chedro.com';
        $manager->password = bcrypt('password');
        $manager->save();
        $manager->roles()->attach($role_manager);

        $staff = new User();
        $staff->name = 'Staff Staff';
        $staff->email = 'staff@chedro.com';
        $staff->password = bcrypt('password');
        $staff->save();
        $staff->roles()->attach($role_staff);

        $customer = new User();
        $customer->name = 'Customer Customer';
        $customer->email = 'customer@chedro.com';
        $customer->password = bcrypt('password');        
        $customer->save();
        $customer->roles()->attach($role_customer);
    }
}
