<?php

use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
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
    return view('template.page');
});


Route::resource('/incidencias', IncidenciaController::class)->names('incidencias');
Route::prefix('administrador')->group(function () {
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/subcategorias', SubcategoriaController::class);

});

