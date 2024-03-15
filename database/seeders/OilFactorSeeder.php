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
            'weighting' => 'Wbdv',
            'scoring' => 'Sbdv',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Water Content (ppm)',
            'weighting' => 'Wwc',
            'scoring' => 'Swc',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Acidity (MgKOH/mg)',
            'weighting' => 'Wacid',
            'scoring' => 'Sacid',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Interfacial Tension (Dyne/cm)',
            'weighting' => 'Wit',
            'scoring' => 'Sit',
        ]);
        DB::table('oil_factors')->insert([
            'parameter' => 'Color Scale',
            'weighting' => 'Wsc',
            'scoring' => 'Scs',
        ]);
    }
}
