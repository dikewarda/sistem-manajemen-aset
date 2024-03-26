<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaperFactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paper_factors')->insert([
            'parameter' => 'CO (ppm)',
            'weightings' => 'Wco',
            'scorings' => 'Sco',
        ]);
        DB::table('paper_factors')->insert([
            'parameter' => 'CO2 (ppm)',
            'weightings' => 'Wco2',
            'scorings' => 'Sco2',
        ]);
        DB::table('paper_factors')->insert([
            'parameter' => 'CO2/CO',
            'weightings' => 'Wco2co',
            'scorings' => 'Sco2co',
        ]);
        DB::table('paper_factors')->insert([
            'parameter' => 'DP estimated (2FAL)',
            'weightings' => 'Wdpest',
            'scorings' => 'Sdpest',
        ]);
        DB::table('paper_factors')->insert([
            'parameter' => 'AGE (year)',
            'weightings' => 'Wage',
            'scorings' => 'Sage',
        ]);
    }
}
