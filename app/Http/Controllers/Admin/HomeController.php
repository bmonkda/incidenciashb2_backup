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
        $estatusespera = Statu::find(1);
        $estatusasignado = Statu::find(2);
        $estatuscerrare = Statu::find(3);
        $estatuscerrano = Statu::find(4);

        // $incidenciascreadas = Incidencia::where('statu_id', $estatuscreado->id)->get();
        // $incidenciascreadascount = Incidencia::where('statu_id', $estatuscreado->id)->count();
        $incidenciascreadas = Incidencia::all();
        $incidenciascreadascount = Incidencia::all()->count();
        $incidenciasespera = Incidencia::where('statu_id', $estatusespera->id)->get();
        $incidenciasesperacount = Incidencia::where('statu_id', $estatusespera->id)->count();
        $incidenciasasignado = Incidencia::where('statu_id', $estatusasignado->id)->get();
        $incidenciasasignadocount = Incidencia::where('statu_id', $estatusasignado->id)->count();
        $incidenciascerrare = Incidencia::where('statu_id', $estatuscerrare->id)->get();
        $incidenciascerrarecount = Incidencia::where('statu_id', $estatuscerrare->id)->count();
        $incidenciascerrano = Incidencia::where('statu_id', $estatuscerrano->id)->get();
        $incidenciascerranocount = Incidencia::where('statu_id', $estatuscerrano->id)->count();

        return view('template.panel', compact(
            'estatuscreado',
            'estatusespera',
            'estatusasignado',
            'estatuscerrare',
            'estatuscerrano',
            'incidenciascreadas','incidenciascreadascount',
            'incidenciasespera','incidenciasesperacount',
            'incidenciasasignado','incidenciasasignadocount',
            'incidenciascerrare','incidenciascerrarecount',
            'incidenciascerrano','incidenciascerranocount',
        ));
    }
}