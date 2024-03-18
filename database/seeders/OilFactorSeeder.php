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
            'weightings' => 'Wbdv',
            'scorings' => 'Sbdv',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Water Content (ppm)',
            'weightings' => 'Wwc',
            'scorings' => 'Swc',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Acidity (MgKOH/mg)',
            'weightings' => 'Wacid',
            'scorings' => 'Sacid',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Interfacial Tension (Dyne/cm)',
            'weightings' => 'Wit',
            'scorings' => 'Sit',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Color Scale',
            'weightings' => 'Wcs',
            'scorings' => 'Scs',
        ]);
    }
}
