<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\BajasController;


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
    return view('auth.login');
});

//Route::resource('articulos','App\Http\Controllers\ArticuloController');
Route::resource('activos','App\Http\Controllers\ActivoController');
Route::resource('bajas','App\Http\Controllers\BajasController');



Route::get('/activos/{id}/historial', [ActivoController::class, 'historial'])->name('activos.historial');
//Route::get('/activos/{activo}/historial', 'HistorialController@showHistorial')->name('historial.show');
//Route::post('/bajas/generar-excel', [BajasController::class, 'store'])->name('bajas.generar-excel');


Route::get('/bajas', [BajasController::class, 'index'])->name('bajas.index');
Route::post('/bajas', [BajasController::class, 'store'])->name('bajas.store');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
