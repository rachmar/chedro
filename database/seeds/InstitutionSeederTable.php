<?php

use App\Model\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('institutions')->truncate();

      $institution = new Institution();
      $institution->name = 'Ateneo De Davao University';
      $institution->save();

      $institution = new Institution();
      $institution->name = 'Brokenshire College';
      $institution->save();

      $institution = new Institution();
      $institution->name = 'San Pedro College';
      $institution->save();

      $institution = new Institution();
      $institution->name = 'Holy Cross College';
      $institution->save();

      $institution = new Institution();
      $institution->name = 'University Of Immaculate Conception';
      $institution->save();

      $institution = new Institution();
      $institution->name = 'University of Southeastern Philippines';
      $institution->save();

    }
}
