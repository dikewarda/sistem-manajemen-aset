<?php

use App\Http\Controllers\Home\HomeController;
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
    return view('home');
});

Route::controller(AdminController::class)->group(function () {
    // GET
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/health-index-calculator', 'hi_calculator')->name('hi_calculator');
    Route::get('/custom-formula', 'custom_formula')->name('custom_formula');
    Route::get('/parameter', 'parameter')->name('parameter');
    Route::get('/transformer-data', 'trafo_data')->name('trafo_data');
    Route::get('/variabel', 'variable')->name('variable');
    Route::get('/get-columns/{name}', 'getColumns')->name('get.columns');
    Route::get('/user', 'user')->name('user');
    Route::get('/database', 'database')->name('database');
    // POST
    Route::post('/calculate-oil-factor', 'calculateOilFactor')->name('calculate.oil.factors');
    Route::post('/calculate-paper-factor', 'calculatePaperFactor')->name('calculate.paper.factors');
    Route::post('/select-formula', 'selectFormula')->name('selectFormula');
    Route::post('/select-formula-paper', 'selectFormulaPaper')->name('selectFormulaPaper');
    Route::post('/add-formula', 'addFormula')->name('add.formula');
    Route::post('/edit-formula', 'editFormula')->name('edit.formula');
    Route::post('/add-variable', 'addVariable')->name('add.variable');
    Route::post('/edit-variable', 'editVariable')->name('edit.variable');
    // DELETE
    Route::delete('/delete-formula/{formulaId}', 'deleteFormula')->name('delete.formula');
    Route::delete('/delete-variable/{variableName}', 'deleteVariable')->name('delete.variable');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
