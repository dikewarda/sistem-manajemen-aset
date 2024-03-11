<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Health Index Calculator Page
    public function index()
    {
        return response()->view('admin.dashboard');
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

    public function hi_calculator()
    {
        return response()->view('admin.health_index');
    }

    public function custom_formula()
    {
        return response()->view('admin.custom_formula');
    }

    public function parameter()
    {
        return response()->view('admin.parameter');
    }

    public function trafo_data()
    {
        return response()->view('admin.trafo_data');
    }

    public function database()
    {
        return response()->view('admin.database');
    }
}
