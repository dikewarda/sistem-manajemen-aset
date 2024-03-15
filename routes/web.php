<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->group(function () {
    // GET
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/health-index-calculator', 'hi_calculator')->name('hi_calculator');
    Route::get('/custom-formula', 'custom_formula')->name('custom_formula');
    Route::get('/parameter', 'parameter')->name('parameter');
    Route::get('/transformer-data', 'trafo_data')->name('trafo_data');
    Route::get('/variabel', 'variable')->name('variable');
    Route::get('/database', 'database')->name('database');
    // POST
    Route::post('/calculate-oil-factor', 'calculateOilFactor')->name('calculate.oil.factors');
    Route::post('/select-formula', 'selectFormula')->name('selectFormula');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
