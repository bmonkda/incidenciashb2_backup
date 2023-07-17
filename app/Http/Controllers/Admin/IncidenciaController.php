<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Emergencia;
use App\Models\Incidencia;
use App\Models\Statu;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $incidencias = Incidencia::with(['statu', 'emergencia', 'categoria', 'subcategoria'])
    //                                 // ->where('user_id', Auth::user()->idusuario) // id de usuario autenticado
    //                                 ->where('statu_id', 1)
    //                                 ->get();

    //     // return $incidencias;
        
    //     return view('admin.incidencias.index', compact('incidencias'));
    // }

    public function index()
    {
        // $estatuscreado = Statu::find(1);
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
            // 'estatuscreado',
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::with(['categoria'])->get();
        $emergencias = Emergencia::all();
        return view('admin.incidencias.create', compact('categorias', 'subcategorias', 'emergencias'));
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
            'archivo' => 'nullable|mimes:jpeg,jpg,png,doc,docx,xls,xlsx,csv,pdf',
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
            'archivo.mimes' => 'El archivo debe ser de tipo JPEG, JPG, PNG, DOC, DOCX, XLS, XLSX, CSV o PDF',
        ];
        
        $this->validate($request, $rules, $messages);

        $incidencia = new Incidencia();
        $incidencia->titulo = $request->input('titulo');
        $incidencia->slug = $request->input('slug');
        $incidencia->descripcion = $request->input('descripcion');
        $incidencia->categoria_id = $request->input('categoria_id');
        $incidencia->subcategoria_id = $request->input('subcategoria_id');
        $incidencia->emergencia_id = $request->input('emergencia_id');

        $incidencia->user_id = auth()->user()->idusuario; //usuario que crea la incidencia

        // Procesar y guardar el archivo
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = $archivo->getClientOriginalName();

            // Verificar que el nombre de archivo no contenga más de un punto
            if (substr_count($nombreArchivo, '.') > 1) {
                return redirect()->back()->withErrors(['archivo' => 'El nombre del archivo no puede contener más de un punto']);
            }

            // Guardar el archivo en una ubicación específica
            $archivo->storeAs('ruta_de_almacenamiento', $nombreArchivo);
            
            $incidencia->archivo = $nombreArchivo;
            $incidencia->extension = $extension;
        }

        $incidencia->saveOrFail();

        return redirect()->route('admin.incidencias.index')->with('info', 'Incidencia creada con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidencia)
    {
        return view('admin.incidencias.show', compact('incidencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidencia)
    {
        $categorias = Categoria::all();
        // $subcategorias = Subcategoria::with(['categoria'])->get();
        $subcategorias = $incidencia->categoria_id ? Subcategoria::where('categoria_id', $incidencia->categoria_id)->get() : collect();
        $emergencias = Emergencia::all();
        $status = Statu::all();
        return view('admin.incidencias.edit', compact('incidencia', 'categorias', 'subcategorias', 'emergencias', 'status'));
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

        return redirect()->route('admin.incidencias.index')->with('info', 'Incidencia actualizada con éxito');
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

        return redirect()->route('admin.incidencias.index')->with('info', 'Incidencia eliminada con éxito');
    }
}
