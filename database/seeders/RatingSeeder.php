<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rating_values')->insert([
            'code' => 'A',
            'condition' => 'Good',
            'value' => 4,
            'min' => null,
            'max' => 1.5,
        ]);
        DB::table('rating_values')->insert([
            'code' => 'B',
            'condition' => 'Acceptable',
            'value' => 3,
            'min' => 1.5,
            'max' => 2.5,
        ]);
        DB::table('rating_values')->insert([
            'code' => 'C',
            'condition' => 'Caution',
            'value' => 2,
            'min' => 2.5,
            'max' => 3.5,
        ]);
        DB::table('rating_values')->insert([
            'code' => 'D',
            'condition' => 'Poor',
            'value' => 1,
            'min' => 3.5,
            'max' => 4.5,
        ]);
        DB::table('rating_values')->insert([
            'code' => 'E',
            'condition' => 'Very Poor',
            'value' => 0,
            'min' => 4.5,
            'max' => null,
        ]);
    }
}
