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

        $sa  = Role::where('name', 'SA')->first();
        $do  = Role::where('name', 'DO')->first();
        $ds  = Role::where('name', 'DS')->first();
        $td  = Role::where('name', 'TD')->first();
        $ad  = Role::where('name', 'AD')->first();

        $rs  = Role::where('name', 'RS')->first();
        $es  = Role::where('name', 'ES')->first();
        $pacd  = Role::where('name', 'PACD')->first();
        $soic  = Role::where('name', 'SOIC')->first();
        $cash  = Role::where('name', 'CASHIER')->first();

        $ceps  = Role::where('name', 'CEPS')->first();

        $super_user = new User();
        $super_user->name = 'Super Admin';
        $super_user->email = 'super@chedro.com';
        $super_user->password = bcrypt('1234');
        $super_user->save();
        $super_user->roles()->attach($sa);

        $pacd_user = new User();
        $pacd_user->name = 'Front Line PACD';
        $pacd_user->email = 'pacd@chedro.com';
        $pacd_user->password = bcrypt('1234');
        $pacd_user->save();
        $pacd_user->roles()->attach($pacd);

        
    }
}
