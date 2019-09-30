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
        
        $sa = new Role();
        $sa->name = 'SA';
        $sa->description = 'SUPER ADMIN';
        $sa->save();

        $do = new Role();
        $do->name = 'CEPS';
        $do->description = 'CEPS';
        $do->save();

        $ds = new Role();
        $ds->name = 'ESII';
        $ds->description = 'ESII';
        $ds->save();

        $td = new Role();
        $td->name = 'EPS';
        $td->description = 'EPS';
        $td->save();

        $ad = new Role();
        $ad->name = 'CAO';
        $ad->description = 'CAO';
        $ad->save();

        $rs = new Role();
        $rs->name = 'RECORDS';
        $rs->description = 'RECORDS';
        $rs->save();

        $es = new Role();
        $es->name = 'ACCT';
        $es->description = 'ACCT';
        $es->save();

        $pacd = new Role();
        $pacd->name = 'PACD';
        $pacd->description = 'PACD';
        $pacd->save();

        $soic = new Role();
        $soic->name = 'SC';
        $soic->description = 'SC';
        $soic->save();

        $cash = new Role();
        $cash->name = 'CASHIER';
        $cash->description = 'CASHIER';
        $cash->save();

        $ceps = new Role();
        $ceps->name = 'PURCHASER';
        $ceps->description = 'PURCHASER';
        $ceps->save();

        $ceps = new Role();
        $ceps->name = 'KTO12';
        $ceps->description = 'KTO12';
        $ceps->save();

        $ceps = new Role();
        $ceps->name = 'UNIFAST';
        $ceps->description = 'UNIFAST';
        $ceps->save();

        $ceps = new Role();
        $ceps->name = 'STUFAPS';
        $ceps->description = 'STUFAPS';
        $ceps->save();
        
    }
}
