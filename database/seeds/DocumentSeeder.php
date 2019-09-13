<?php

use App\Model\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->truncate();
        
        $document = new Document();
        $document->name = 'Application for Government Permit/Recognition';
        $document->save();

        $document = new Document();
        $document->name = 'Application for Laboratory Accreditation';
        $document->save();

        $document = new Document();
        $document->name = 'Application for TOSF Increase';
        $document->save();

		$document = new Document();
        $document->name = 'School Calendar';
        $document->save();

        $document = new Document();
        $document->name = 'Promotional Report';
        $document->save();

        $document = new Document();
        $document->name = 'Enrolment List';
        $document->save();

        $document = new Document();
        $document->name = 'NSTP Reports';
        $document->save();

        $document = new Document();
        $document->name = 'Curriculum';
        $document->save();

        $document = new Document();
        $document->name = 'Compliance of deficiencies';
        $document->save();

        $document = new Document();
        $document->name = 'Request for Endorsement of Activity for MRD';
        $document->save();

        $document = new Document();
        $document->name = 'Request for Data';
        $document->save();

        $document = new Document();
        $document->name = 'Request for SEC Endorsement';
        $document->save();

        $document = new Document();
        $document->name = 'Request for Assistance/complaints';
        $document->save();

        $document = new Document();
        $document->name = 'Request for Appointment/appearance to a meeting or activity';
        $document->save();

         
    }
}
