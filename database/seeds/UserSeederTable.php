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

        $ADMIN  = Role::where('name', 'ADMIN')->first();

        $user = new User();
        $user->name = 'ADMIN ADMIN';
        $user->email = 'admin@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($ADMIN);


        // TECHNICAL DIVISION

        $CEPS  = Role::where('name', 'CEPS')->first();

        $user = new User();
        $user->name = 'CEPS CEPS';
        $user->email = 'ceps@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($CEPS);

        $ESII  = Role::where('name', 'ESII')->first();

        $user = new User();
        $user->name = 'ESII ESII';
        $user->email = 'esii@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($ESII);

        $EPS  = Role::where('name', 'EPS')->first();

        $user = new User();
        $user->name = 'EPS EPS';
        $user->email = 'eps@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($EPS);

        // END TECHNICAL DIVISION



        // ADMINISTRATIVE

        $CAO  = Role::where('name', 'CAO')->first();

        $user = new User();
        $user->name = 'CAO CAO';
        $user->email = 'cao@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($CAO);

        $ACCT  = Role::where('name', 'ACCT')->first();

        $user = new User();
        $user->name = 'ACCT ACCT';
        $user->email = 'acct@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($ACCT);

        $SECRETARY  = Role::where('name', 'SECRETARY')->first();

        $user = new User();
        $user->name = 'SECRETARY SECRETARY';
        $user->email = 'secretary@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($SECRETARY);

        $CASHIER  = Role::where('name', 'CASHIER')->first();

        $user = new User();
        $user->name = 'CASHIER CASHIER';
        $user->email = 'cashier@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($CASHIER);

        $RECORD  = Role::where('name', 'RECORD')->first();

        $user = new User();
        $user->name = 'RECORD RECORD';
        $user->email = 'record@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($RECORD);

        $PACD  = Role::where('name', 'PACD')->first();

        $user = new User();
        $user->name = 'PACD PACD';
        $user->email = 'pacd@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($PACD);

        $PURCHASER  = Role::where('name', 'PURCHASER')->first();
        
        $user = new User();
        $user->name = 'PURCHASER PURCHASER';
        $user->email = 'purchaser@chedro.com';
        $user->password = bcrypt('adminadmin');
        $user->save();
        $user->roles()->attach($PURCHASER);

        // END ADMINISTRATIVE

        
        
    }
}
