<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       	$this->call(RoleSeederTable::class);
        $this->call(UserSeederTable::class);
        $this->call(DocumentSeeder::class);
        $this->call(StatusSeederTable::class);

    }
}
