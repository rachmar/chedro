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
        $sa->description = 'Super Admin';
        $sa->save();

        $do = new Role();
        $do->name = 'DO';
        $do->description = 'Director’s Office';
        $do->save();

        $ds = new Role();
        $ds->name = 'DS';
        $ds->description = 'Director’s Secretary';
        $ds->save();

        $td = new Role();
        $td->name = 'TD';
        $td->description = 'Technical Division';
        $td->save();

        $ad = new Role();
        $ad->name = 'AD';
        $ad->description = 'Adminstrative Division';
        $ad->save();

        $rs = new Role();
        $rs->name = 'RS';
        $rs->description = 'Record’s Section';
        $rs->save();

        $es = new Role();
        $es->name = 'ES';
        $es->description = 'Education Supervisor';
        $es->save();

        $pacd = new Role();
        $pacd->name = 'PACD';
        $pacd->description = 'Front Line / PACD';
        $pacd->save();

        $soic = new Role();
        $soic->name = 'SOIC';
        $soic->description = 'Special Order In-charge';
        $soic->save();

        $cash = new Role();
        $cash->name = 'CASHIER';
        $cash->description = 'Cashier';
        $cash->save();

        $ceps = new Role();
        $ceps->name = 'CEPS';
        $ceps->description = 'CEPS';
        $ceps->save();
        
    }
}
