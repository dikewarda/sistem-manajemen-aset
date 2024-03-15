<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables')->insert([
            'variable' => 'scorings',
            'jumlah_data' => 20,
        ]);
        DB::table('variables')->insert([
            'variable' => 'weightings',
            'jumlah_data' => 5,
        ]);
    }
}
