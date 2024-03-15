<?php

namespace App\Http\Controllers;

use App\Models\formula;
use App\Models\oil_factor;
use App\Models\variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
        return response()->view('admin.dashboard');
    }

    // Health Index Calculator Page
    public function hi_calculator()
    {
        $formulas = formula::all();
        return view('admin.health_index', compact('formulas'));
    }

    public function selectFormula(Request $request)
    {
        $formulas = formula::all();
        $selectedFormula = $request->input('selectFormula');
        preg_match_all('/([a-zA-Z]+)/', $selectedFormula, $matches);
        $variables = $matches[0];
        $matchedData = [];

        foreach ($variables as $variable) {
            // Mencari data yang sesuai berdasarkan kolom 'weighting'
            $weightingData = oil_factor::where('weighting', $variable)->first();

            // Mencari data yang sesuai berdasarkan kolom 'scoring'
            $scoringData = oil_factor::where('scoring', $variable)->first();

            // Jika data ditemukan untuk kedua kolom, simpan parameter, weighting, dan scoring
            if ($weightingData && $scoringData) {
                $matchedData[] = [
                    'parameter' => $weightingData->parameter,
                    'weighting' => $weightingData->weighting,
                    'scoring' => $scoringData->scoring,
                ];
            }
        }
        return view('admin.health_index', compact('matchedData', 'variables', 'formulas'));
    }

    public function calculateOilFactor(Request $request)
    {
        $request->validate([
            'bdv' => 'required',
            'waterContent' => 'required',
            'acidity' => 'required',
            'tension' => 'required',
            'colorScale' => 'required',
        ]);
    }

    public function custom_formula()
    {
        $formulas = formula::all();
        return view('admin.custom_formula', compact('formulas'));
    }

    // Parameter Page
    public function parameter()
    {
        $oilFactor = oil_factor::get();
        return response()->view('admin.parameter', compact('oilFactor'));
    }

    public function trafo_data()
    {
        return response()->view('admin.trafo_data');
    }

    public function variable()
    {
        $variable = DB::table('variables')->get();
        $data = [];

        foreach ($variable as $var) {
            $tableName = $var->variable;
            $columns = Schema::getColumnListing($tableName);
            $tableData = DB::table($tableName)->get();
            $tableData = $tableData->toArray();

            $data[$tableName]['columns'] = $columns;
            $data[$tableName]['rows'] = $tableData;
        }
        // dd($data);
        return view('admin.variable', compact('variable', 'data'));
    }

    public function database()
    {
        return response()->view('admin.database');
    }
}
