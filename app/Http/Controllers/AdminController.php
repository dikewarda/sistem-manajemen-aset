<?php

namespace App\Http\Controllers;

use App\Models\formula;
use App\Models\oil_factor;
use App\Models\paper_factor;
use App\Models\variable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

    public function selectFormulaPaper(Request $request)
    {
        $formulas = formula::all();
        $selectFormulaPaper = $request->input('selectFormulaPaper');
        $request->session()->put('paperFormula', $selectFormulaPaper);
        $compare = variable::all();

        $matchedParameters = [];

        preg_match_all('/\b[A-Za-z]+\b/', $selectFormulaPaper, $variables);
        preg_match_all('/[+\-*\/\(\)]/', $selectFormulaPaper, $operators);

        $parsedFormula = [
            'variables' => $variables[0],
            'operators' => $operators[0]
        ];

        Log::info('parsedFormula', $parsedFormula);

        foreach ($parsedFormula['variables'] as $variable) {
            $matchedFactor = paper_factor::where('weightings', $variable)
                ->orWhere('scorings', $variable)
                ->first();

            if ($matchedFactor) {
                $matchedParameters[] = $matchedFactor->parameter;
            }
        }
        $request->session()->put('parsedPaperFormula', $parsedFormula);

        $matchParameters = array_unique($matchedParameters);

        return view('admin.partial.paper', compact('formulas', 'matchParameters', 'compare'));
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

    public function calculatePaperFactor(Request $request)
    {
        $parsedFormula = $request->session()->get('parsedPaperFormula');
        $rumus = $request->session()->get('paperFormula');
        $variable = DB::table('variables')->get();
        $paperFactors = paper_factor::all();
        $paperFactor = Schema::getColumnListing('paper_factors');
        $coba = [];
        $data = [];
        foreach ($variable as $var) {
            $tableName = $var->variable;
            if (in_array($tableName, $paperFactor)) {
                if (Schema::hasColumns($tableName, ['min', 'max'])) {
                    foreach ($request->except('_token') as $key => $value) {
                        $matchedFactor = $paperFactors->where('parameter', str_replace('_', ' ', $key))->first();
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
        $compareTable = $request->comparison_paper;
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
        return view('admin.partial.paper_result', compact('result', 'rating'));
    }

    // Custom Formula Page
    public function custom_formula()
    {
        $formulas = formula::all();
        $variables = DB::table('variables')->pluck('variable')->toArray();
        $data = [];
        foreach ($variables as $var) {
            if (Schema::hasTable($var)) {
                $columns = Schema::getColumnListing($var);
                if (in_array('variable', $columns)) {
                    $tableData = DB::table($var)->pluck('variable')->unique()->toArray();
                    $data[$var] = $tableData;
                }
            }
        }
        $data['operators'] = ['+', '-', '*', '/', '%', '**', '(', ')'];
        return view('admin.custom_formula', compact('formulas', 'data'));
    }

    public function addFormula(Request $request)
    {
        $formula = str_replace(' ', ',', $request->formula);

        formula::create([
            'name' => $request->formula_name,
            'formula' => $formula,
        ]);

        return redirect()->back();
    }

    public function editFormula(Request $request)
    {
        $formulaId = $request->formula_id;

        $formula = Formula::find($formulaId);

        if ($formula) {
            $formula->name = $request->edit_formula_name;
            $formula->formula = str_replace(' ', ',', $request->edit_formula);

            $formula->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function deleteFormula($formulaId)
    {
        $formula = Formula::find($formulaId);

        if ($formula) {
            $formula->delete();
            return response()->json(['message' => 'Formula berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Formula tidak ditemukan'], 404);
        }
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

    // Variable Page
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

    public function addVariable(Request $request)
    {
        $tableName = $request->input('variable_name');
        $columns = $request->input('column');
        $types = $request->input('tipe');

        Schema::create($tableName, function ($table) use ($columns, $types) {
            $table->id();
            $variableColumns = ['variable', 'min', 'max', 'value'];
            $typeIndex = 0;
            foreach ($columns as $index => $column) {
                if (in_array($column, $variableColumns)) {
                    $type = null;
                    if ($column === 'variable') {
                        $type = 'string';
                    } elseif (in_array($column, ['value', 'min', 'max'])) {
                        $type = 'float';
                    } else {
                        $type = Arr::get($types, $typeIndex);
                    }
                } else {
                    $type = isset($types[$typeIndex]) ? $types[$typeIndex] : null;
                    $typeIndex++;
                }

                if ($type === 'string') {
                    $table->string($column);
                } elseif ($type === 'integer') {
                    $table->integer($column);
                } elseif ($type === 'date') {
                    $table->date($column);
                } elseif ($type === 'time') {
                    $table->time($column);
                } elseif ($type === 'float') {
                    $table->float($column, 10, 5);
                } elseif ($type === 'boolean') {
                    $table->boolean($column);
                } elseif ($type === 'text') {
                    $table->text($column);
                }
            }
        });

        $variable = new variable();
        $variable->variable = $request->input('variable_name');
        $variable->jumlah_data = count($request->input('column'));
        $variable->save();
        return redirect()->back();
    }

    public function getColumns($name)
    {
        $columns = Schema::getColumnListing($name);
        $columns = array_diff($columns, ['created_at', 'updated_at']);
        return response()->json(['columns' => $columns]);
    }

    public function editVariable(Request $request)
    {
        dd($request);
    }

    public function deleteVariable($variableName)
    {
        $variable = DB::table('variables')->where('variable', $variableName);

        if ($variable) {
            $variable->delete();
            $namaTabel = str_replace(' ', '_', strtolower($variableName));
            DB::statement("DROP TABLE `$namaTabel`");
            return response()->json(['message' => 'variable berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'variable tidak ditemukan'], 404);
        }
    }

    public function user()
    {
        return response()->view('admin.user.index');
    }

    public function database()
    {
        return response()->view('admin.database');
    }
}
