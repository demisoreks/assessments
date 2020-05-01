<?php

use Illuminate\Database\Seeder;

use App\AssAssessment;

class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssAssessment::create([
            'title' => '',
            'information' => ''
        ]);
    }
}
