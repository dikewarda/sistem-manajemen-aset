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
        //BDV
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
    }
}
