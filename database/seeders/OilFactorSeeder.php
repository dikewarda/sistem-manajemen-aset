<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OilFactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oil_factors')->insert([
            'parameter' => 'Break Down Voltage (kV)',
            'weight' => 0.169,
            'score1' => 50,
            'score2' => 45,
            'score3' => 40,
            'score4' => 40,
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Water Content (ppm)',
            'weight' => 0.108,
            'score1' => 20,
            'score2' => 25,
            'score3' => 30,
            'score4' => 30,
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Acidity (MgKOH/mg)',
            'weight' => 0.139,
            'score1' => 0.1,
            'score2' => 0.15,
            'score3' => 0.2,
            'score4' => 0.2,
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Interfacial Tension (Dyne/cm)',
            'weight' => 0.124,
            'score1' => 35,
            'score2' => 25,
            'score3' => 20,
            'score4' => 20,
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Color Scale',
            'weight' => 0.114,
            'score1' => 1.5,
            'score2' => 2,
            'score3' => 2.5,
            'score4' => 2.5,
        ]);
    }
}
