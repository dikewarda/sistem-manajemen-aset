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
            'weight' => 0.169,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wwc',
            'weight' => 0.108,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wacid',
            'weight' => 0.139,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wit',
            'weight' => 0.124,
        ]);
        DB::table('weightings')->insert([
            'variable' => 'Wsc',
            'weight' => 0.114,
        ]);
    }
}
