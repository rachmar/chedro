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
        
        $ADMIN = new Role();
        $ADMIN->name = 'ADMIN';
        $ADMIN->description = 'ADMIN';
        $ADMIN->save();


        // TECHNICAL DIVISION

        $CEPS = new Role();
        $CEPS->name = 'CEPS';
        $CEPS->description = 'CEPS';
        $CEPS->save();

        $ESII = new Role();
        $ESII->name = 'ESII';
        $ESII->description = 'ESII';
        $ESII->save();

        $EPS = new Role();
        $EPS->name = 'EPS';
        $EPS->description = 'EPS';
        $EPS->save();

        // END TECHNICAL DIVISION

        // ADMINISTRATIVE

        $CAO = new Role();
        $CAO->name = 'CAO';
        $CAO->description = 'CAO';
        $CAO->save();

        $ACCT = new Role();
        $ACCT->name = 'ACCT';
        $ACCT->description = 'ACCT';
        $ACCT->save();

        $SECRETARY = new Role();
        $SECRETARY->name = 'SECRETARY';
        $SECRETARY->description = 'SECRETARY';
        $SECRETARY->save();

        $CASHIER = new Role();
        $CASHIER->name = 'CASHIER';
        $CASHIER->description = 'CASHIER';
        $CASHIER->save();

        $RECORD = new Role();
        $RECORD->name = 'RECORD';
        $RECORD->description = 'RECORD';
        $RECORD->save();

        $PACD = new Role();
        $PACD->name = 'PACD';
        $PACD->description = 'PACD';
        $PACD->save();

        $PURCHASER = new Role();
        $PURCHASER->name = 'PURCHASER';
        $PURCHASER->description = 'PURCHASER';
        $PURCHASER->save();

        // END ADMINISTRATIVE
        
    }
}
