<?php

namespace App\Http\Controllers;

use App\Models\formula;
use App\Models\oil_factor;
use App\Models\variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $compare = variable::all();
        return view('admin.health_index', compact('formulas', 'compare'));
    }

    public function selectFormula(Request $request)
    {
        $formulas = formula::all();
        $selectedFormula = $request->input('selectFormula');
        $request->session()->put('formula', $selectedFormula);
        $compare = variable::all();

        $oilFactors = oil_factor::all();
        $matchedParameters = [];

        preg_match_all('/\b[A-Za-z]+\b/', $selectedFormula, $variables);
        preg_match_all('/[+\-*\/\(\)]/', $selectedFormula, $operators);

        $parsedFormula = [
            'variables' => $variables[0],
            'operators' => $operators[0]
        ];

        foreach ($parsedFormula['variables'] as $variable) {
            $matchedFactor = oil_factor::where('weightings', $variable)
                ->orWhere('scorings', $variable)
                ->first();

            if ($matchedFactor) {
                $matchedParameters[] = $matchedFactor->parameter;
            }
        }
        $request->session()->put('parsedFormula', $parsedFormula);

        $matchParameters = array_unique($matchedParameters);

        return view('admin.partial.health_index', compact('formulas', 'matchParameters', 'compare'));
    }

    public function calculateOilFactor(Request $request)
    {
        $parsedFormula = $request->session()->get('parsedFormula');
        $rumus = $request->session()->get('formula');
        $variable = DB::table('variables')->get();
        $oilFactors = oil_factor::all();
        $oilFactor = Schema::getColumnListing('oil_factors');
        $coba = [];
        $data = [];
        foreach ($variable as $var) {
            $tableName = $var->variable;
            if (in_array($tableName, $oilFactor)) {
                if (Schema::hasColumns($tableName, ['min', 'max'])) {
                    foreach ($request->except('_token') as $key => $value) {
                        $matchedFactor = $oilFactors->where('parameter', str_replace('_', ' ', $key))->first();
                        if ($matchedFactor) {
                            $data[$matchedFactor->$tableName] = $value;
                        }
                    }
                    foreach ($data as $dataKey => $dataValue) {
                        $dataValueFloat = floatval($dataValue);
                        $minMax = DB::table($tableName)->where('variable', $dataKey)->get();

                        foreach ($minMax as $mm) {
                            if ($mm) {
                                $min = floatval($mm->min);
                                $max = floatval($mm->max);
                                $coba[] = $max;
                                if ($min !== null && $max !== null) {
                                    if ($dataValueFloat > $min && $dataValueFloat < $max) {
                                        $data[$dataKey] = $mm->value;
                                    }
                                } elseif ($min === null && $max !== null) {
                                    if ($dataValueFloat < $max) {
                                        $data[$dataKey] = $mm->value;
                                    }
                                } elseif ($max === null && $min !== null) {
                                    if ($dataValueFloat > $min) {
                                        $data[$dataKey] = $mm->value;
                                    }
                                }
                            }
                        }
                    }
                    foreach ($parsedFormula['variables'] as $parsedKey => $parsedVariable) {
                        if (isset($data[$parsedVariable])) {
                            $parsedFormula['variables'][$parsedKey] = $data[$parsedVariable];
                        }
                    }
                } else {
                    foreach ($parsedFormula['variables'] as $parsedKey => $parsedVariable) {
                        $score = DB::table($tableName)->where('variable', $parsedVariable)->first();
                        if ($score) {
                            $parsedFormula['variables'][$parsedKey] = $score->value;
                        }
                    }
                }
            }
        }
        $tokens = explode(',', $rumus);

        $indexVariable = 0;

        foreach ($tokens as &$token) {
            if (!in_array($token, ['(', ')', '*', '/', '+', '-', '%', '**'])) {
                if ($indexVariable < count($parsedFormula['variables'])) {
                    $token = $parsedFormula['variables'][$indexVariable];
                }
                $indexVariable++;
            }
        }

        $rumus = implode('', $tokens);
        $result = eval("return $rumus;");

        // comparison
        $compareTable = $request->comparison;
        $rating = [];
        $minMax = DB::table($compareTable)->get();

        foreach ($minMax as $mm) {
            if ($mm) {
                $min = floatval($mm->min);
                $max = floatval($mm->max);
                if ($min !== null && $max !== null) {
                    if ($result > $min && $result < $max) {
                        $rating['score'] = $mm->value;
                        $rating['code'] = $mm->code;
                        $rating['condition'] = $mm->condition;
                    }
                } elseif ($min === null && $max !== null) {
                    if ($result < $max) {
                        $rating['score'] = $mm->value;
                        $rating['code'] = $mm->code;
                        $rating['condition'] = $mm->condition;
                    }
                } elseif ($max === null && $min !== null) {
                    if ($result > $min) {
                        $rating['score'] = $mm->value;
                        $rating['code'] = $mm->code;
                        $rating['condition'] = $mm->condition;
                    }
                }
            }
        }
        // dd($result, $rating);
        return view('admin.partial.oil_result', compact('result', 'rating'));
    }

    // Custom Formula Page
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
