<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //OIL FACTORS
        DB::table('weightings')->insert([
            'variable' => 'Wbdv',
            'value' => 0.169,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wwc',
            'value' => 0.108,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wacid',
            'value' => 0.139,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wit',
            'value' => 0.124,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wcs',
            'value' => 0.114,
        ]);

        //PAPER FACTORS
        DB::table('weightings')->insert([
            'variable' => 'Wco',
            'value' => 0.092,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wco2',
            'value' => 0.092,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wco2co',
            'value' => 0.092,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wdpest',
            'value' => 0.378,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wage',
            'value' => 0.346,
        ]);
    }
}
