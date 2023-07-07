<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use App\Models\Statu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $estatuscreado = Statu::find(1);
        $estatusespera = Statu::find(2);
        $estatusaignado = Statu::find(3);
        $estatuscerrare = Statu::find(4);
        $estatuscerrano = Statu::find(5);

        $incidenciascreadas = Incidencia::where('statu_id', $estatuscreado->id)->get();
        $incidenciascreadascount = Incidencia::where('statu_id', $estatuscreado->id)->count();
        $incidenciasespera = Incidencia::where('statu_id', $estatusespera->id)->get();
        $incidenciasesperacount = Incidencia::where('statu_id', $estatusespera->id)->count();
        $incidenciasaignado = Incidencia::where('statu_id', $estatusaignado->id)->get();
        $incidenciasaignadocount = Incidencia::where('statu_id', $estatusaignado->id)->count();
        $incidenciascerrare = Incidencia::where('statu_id', $estatuscerrare->id)->get();
        $incidenciascerrarecount = Incidencia::where('statu_id', $estatuscerrare->id)->count();
        $incidenciascerrano = Incidencia::where('statu_id', $estatuscerrano->id)->get();
        $incidenciascerranocount = Incidencia::where('statu_id', $estatuscerrano->id)->count();

        return view('template.panel', compact('estatuscreado',
        'estatusespera',
        'estatusaignado',
        'estatuscerrare',
        'estatuscerrano',
        'incidenciascreadas','incidenciascreadascount',
        'incidenciasespera','incidenciasesperacount',
        'incidenciasaignado','incidenciasaignadocount',
        'incidenciascerrare','incidenciascerrarecount',
        'incidenciascerrano','incidenciascerranocount',));
    }
}