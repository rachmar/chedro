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

        $pacd  = Role::where('name', 'PACD')->first();

        $sc  = Role::where('name', 'SC')->first();

        $super_user = new User();
        $super_user->name = 'SUPER ADMIN';
        $super_user->email = 'super@chedro.com';
        $super_user->password = bcrypt('1234');
        $super_user->save();
        $super_user->roles()->attach($sa);

        $pacd_user = new User();
        $pacd_user->name = 'PACD';
        $pacd_user->email = 'pacd@chedro.com';
        $pacd_user->password = bcrypt('1234');
        $pacd_user->save();
        $pacd_user->roles()->attach($pacd);

        $sc_user = new User();
        $sc_user->name = 'SC1';
        $sc_user->email = 'sc@chedro.com';
        $sc_user->password = bcrypt('1234');
        $sc_user->save();
        $sc_user->roles()->attach($sc);

        $sc_user = new User();
        $sc_user->name = 'SC2';
        $sc_user->email = 'sc2@chedro.com';
        $sc_user->password = bcrypt('1234');
        $sc_user->save();
        $sc_user->roles()->attach($sc);

        
    }
}
