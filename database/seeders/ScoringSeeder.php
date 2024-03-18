<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BDV
        DB::table('scorings')->insert([
            'variable' => 'Sbdv',
            'value' => 1,
            'min' => 50,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sbdv',
            'value' => 2,
            'min' => 45,
            'max' => 50,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sbdv',
            'value' => 3,
            'min' => 40,
            'max' => 45,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sbdv',
            'value' => 4,
            'max' => 40,
        ]);
        // WATER CONTENT
        DB::table('scorings')->insert([
            'variable' => 'Swc',
            'value' => 1,
            'max' => 20,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Swc',
            'value' => 2,
            'min' => 20,
            'max' => 25,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Swc',
            'value' => 3,
            'min' => 25,
            'max' => 30,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Swc',
            'value' => 4,
            'min' => 30,
        ]);
        // ACIDITY
        DB::table('scorings')->insert([
            'variable' => 'Sacid',
            'value' => 1,
            'max' => 0.1,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sacid',
            'value' => 2,
            'min' => 0.1,
            'max' => 0.15,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sacid',
            'value' => 3,
            'min' => 0.15,
            'max' => 0.20,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sacid',
            'value' => 4,
            'min' => 0.20,
        ]);
        // INTERFACIAL TENSION
        DB::table('scorings')->insert([
            'variable' => 'Sit',
            'value' => 1,
            'min' => 35,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sit',
            'value' => 2,
            'min' => 25,
            'max' => 35,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sit',
            'value' => 3,
            'min' => 20,
            'max' => 25,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Sit',
            'value' => 4,
            'max' => 20,
        ]);
        // COLOR SCALE
        DB::table('scorings')->insert([
            'variable' => 'Scs',
            'value' => 1,
            'max' => 1.5,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Scs',
            'value' => 2,
            'min' => 1.5,
            'max' => 2,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Scs',
            'value' => 3,
            'min' => 2,
            'max' => 2.5,
        ]);
        DB::table('scorings')->insert([
            'variable' => 'Scs',
            'value' => 4,
            'min' => 2.5,
        ]);
    }
}