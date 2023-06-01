<?php

use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\StatuController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Statu;
use App\Models\Incidencia;

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

// Route::get('/', function () {
//     $estatuscreado = Statu::find(1);
//     $estatusespera = Statu::find(2);
//     $estatusaignado = Statu::find(3);
//     $estatuscerrare = Statu::find(4);
//     $estatuscerrano = Statu::find(5);

//     $incidenciascreadas = Incidencia::where('statu_id', $estatuscreado->id)->get();
//     $incidenciascreadascount = Incidencia::where('statu_id', $estatuscreado->id)->count();
//     $incidenciasespera = Incidencia::where('statu_id', $estatusespera->id)->get();
//     $incidenciasesperacount = Incidencia::where('statu_id', $estatusespera->id)->count();
//     $incidenciasaignado = Incidencia::where('statu_id', $estatusaignado->id)->get();
//     $incidenciasaignadocount = Incidencia::where('statu_id', $estatusaignado->id)->count();
//     $incidenciascerrare = Incidencia::where('statu_id', $estatuscerrare->id)->get();
//     $incidenciascerrarecount = Incidencia::where('statu_id', $estatuscerrare->id)->count();
//     $incidenciascerrano = Incidencia::where('statu_id', $estatuscerrano->id)->get();
//     $incidenciascerranocount = Incidencia::where('statu_id', $estatuscerrano->id)->count();

//     return view('template.page', compact('estatuscreado',
//     'estatusespera',
//     'estatusaignado',
//     'estatuscerrare',
//     'estatuscerrano',
//     'incidenciascreadas','incidenciascreadascount',
//     'incidenciasespera','incidenciasesperacount',
//     'incidenciasaignado','incidenciasaignadocount',
//     'incidenciascerrare','incidenciascerrarecount',
//     'incidenciascerrano','incidenciascerranocount',

//     ));
// });

Route::get('/', [HomeController::class,'index'])->name('home')->middleware('auth');

Route::resource('/incidencias', IncidenciaController::class);

Route::prefix('administrador')->group(function () {
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/subcategorias', SubcategoriaController::class);
    Route::resource('/estatus', StatuController::class);
    Route::resource('/emergencias', EmergenciaController::class);

});

