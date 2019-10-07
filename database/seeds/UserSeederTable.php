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

        $admin  = Role::where('name', 'ADMIN')->first();
        $pacd  = Role::where('name', 'PACD')->first();
        $sect  = Role::where('name', 'SECT')->first();
        $cao  = Role::where('name', 'CAO')->first();
        $ceps  = Role::where('name', 'CAO')->first();

        $user = new User();
        $user->name = 'ADMIN ADMIN';
        $user->email = 'admin@chedro.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($admin);

        $user = new User();
        $user->name = 'PACD PACD';
        $user->email = 'pacd@chedro.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($pacd);

        $user = new User();
        $user->name = 'CEPS CEPS';
        $user->email = 'ceps@chedro.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($ceps);

        $user = new User();
        $user->name = 'CAO CAO';
        $user->email = 'cao@chedro.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($cao);

        $user = new User();
        $user->name = 'SECT SECT';
        $user->email = 'sect@chedro.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($sect);

        
    }
}
