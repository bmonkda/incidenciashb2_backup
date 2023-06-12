<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
use App\Models\Incidencia;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencias = Incidencia::with(['statu', 'emergencia', 'categoria', 'subcategoria'])
                                    ->where('user_id', Auth::user()->idusuario) // id de usuario autenticado
                                    ->get();

        // return $incidencias;
        
        return view('incidencias.index', compact('incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategorias = Subcategoria::with(['categoria'])->get();
        $emergencias = Emergencia::all();
        return view('incidencias.create', compact('subcategorias', 'emergencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required|min:5',
            'slug' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'emergencia_id' => 'required|exists:emergencias,id',
        ];

        $messages = [
            'titulo.required' => 'Es necesario ingresar un título para la incidencia',
            'titulo.min' => 'El título debe contener al menos 5 caracteres',
            'slug.required' => 'Es necesario ingresar el título',
            'slug.min' => 'El título debe contener al menos 5 caracteres',
            'descripcion.required' => 'Es necesario ingresar una descripcion para la incidencia',
            'descripcion.min' => 'El descripcion debe contener al menos 10 caracteres',
            'categoria_id.required' => 'Es necesario seleccionar una categoría',
            'subcategoria_id.required' => 'Es necesario seleccionar una subcategoría',
            'emergencia_id.required' => 'Es necesario seleccionar tipo urgencia',
            
        ];
        
        $this->validate($request, $rules, $messages);

        $incidencia = new Incidencia();
        $incidencia->titulo = $request->input('titulo');
        $incidencia->slug = $request->input('slug');
        $incidencia->descripcion = $request->input('descripcion');
        $incidencia->categoria_id = $request->input('categoria_id');
        $incidencia->subcategoria_id = $request->input('subcategoria_id');
        $incidencia->emergencia_id = $request->input('emergencia_id');

        $incidencia->user_id = auth()->user()->idusuario;

        $incidencia->saveOrFail();

        //return $request;
        //return $incidencia;

        return redirect()->route('incidencias.index')->with('info', 'Incidencia creada con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidencia)
    {
        return view('incidencias.show', compact('incidencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidencia)
    {
        $subcategorias = Subcategoria::with(['categoria'])->get();
        $emergencias = Emergencia::all();
        return view('incidencias.edit', compact('incidencia','subcategorias', 'emergencias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        $rules = [
            'titulo' => 'required|min:5',
            'slug' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'emergencia_id' => 'required|exists:emergencias,id',
        ];

        $messages = [
            'titulo.required' => 'Es necesario ingresar un título para la incidencia',
            'titulo.min' => 'El título debe contener al menos 5 caracteres',
            'slug.required' => 'Es necesario ingresar el título',
            'slug.min' => 'El título debe contener al menos 5 caracteres',
            'descripcion.required' => 'Es necesario ingresar una descripción para la incidencia',
            'descripcion.min' => 'La descripción debe contener al menos 10 caracteres',
            'categoria_id.required' => 'Es necesario seleccionar una categoría',
            'subcategoria_id.required' => 'Es necesario seleccionar una subcategoría',
            'emergencia_id.required' => 'Es necesario seleccionar una urgencia',
        ];

        $this->validate($request, $rules, $messages);

        $incidencia->titulo = $request->input('titulo');
        $incidencia->slug = $request->input('slug');
        $incidencia->descripcion = $request->input('descripcion');
        $incidencia->categoria_id = $request->input('categoria_id');
        $incidencia->subcategoria_id = $request->input('subcategoria_id');
        $incidencia->emergencia_id = $request->input('emergencia_id');

        $incidencia->save();

        return redirect()->route('incidencias.index')->with('info', 'Incidencia actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();

        return redirect()->route('incidencias.index')->with('info', 'Incidencia eliminada con éxito');
    }
}
