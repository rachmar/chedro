<?php

use App\Model\Log;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->truncate();

        $log = new Log();
        $log->user_id = '1';
        $log->description = 'First BURST';
        $log->save();

        $log = new Log();
        $log->user_id = '2';
        $log->description = 'BURTSSSSS';
        $log->save();

        $log = new Log();
        $log->user_id = '3';
        $log->description = 'TRPRRWRWRARSRSR';
        $log->save();

        $log = new Log();
        $log->user_id = '1';
        $log->description = '2nd BURST';
        $log->save();


    }
}
