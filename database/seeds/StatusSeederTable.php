<?php

use App\Model\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('status')->truncate();
        
        $status = new Status();
        $status->name = 'Action Please';
        $status->save();

        $status = new Status();
        $status->name = 'For Comment And Recom';
        $status->save();

        $status = new Status();
        $status->name = 'For Endorsement';
        $status->save();

        $status = new Status();
        $status->name = 'For Approval';
        $status->save();

        $status = new Status();
        $status->name = 'For Verification';
        $status->save();

        $status = new Status();
        $status->name = 'Submit Report';
        $status->save();

        $status = new Status();
        $status->name = 'Represent Me';
        $status->save();

        $status = new Status();
        $status->name = 'See Me';
        $status->save();

        $status = new Status();
        $status->name = 'Attend / Send Representative';
        $status->save();

        $status = new Status();
        $status->name = 'For Information';
        $status->save();

        $status = new Status();
        $status->name = 'For Dissemination';
        $status->save();

        $status = new Status();
        $status->name = 'Re-Type';
        $status->save();

        $status = new Status();
        $status->name = 'File';
        $status->save();

     
    }
}
