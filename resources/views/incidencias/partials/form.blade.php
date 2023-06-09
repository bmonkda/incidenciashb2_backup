<div class="form-group">
    <label for="titulo">Título*:</label>
    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese el título de la incidencia">

    @error('titulo')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="slug">Slug:</label>
    <input type="text" name="slug" id="slug" class="form-control" {{-- value="{{ $slug }}" --}} placeholder="Slug de la incidencia" readonly>

    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción*:</label>
    <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese la descripción de la incidencia">{{-- {{ $descripcion }} --}}</textarea>
    
    @error('descripcion')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label>Categoría*</label>
    <select class="form-control" name="categoria_id" id="categoriaSelect">
        {{-- <option value="">Seleccione una categoría</option> --}}
        <option selected disabled>Selecionar Categoria</option>
        @foreach ($subcategorias->unique('categoria_id') as $subcategoria)
            <option value="{{ $subcategoria->categoria->id }}">{{ $subcategoria->categoria->id }} - {{ $subcategoria->categoria->nombre }}</option>
        @endforeach
    </select>

    @error('categoria_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <label>Subcategoría*</label>
    <select class="form-control" name="subcategoria_id" id="subcategoriaSelect">
        <option value="">Debe seleccionar una Categoría</option>
    </select>

    @error('subcategoria_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label>Urgencia*</label>
    <select class="form-control" name="emergency_id" id="emrgencia">
        <option selected disabled>Selecionar Urgencia</option>
        @foreach ($emergencias as $emergencia)
            <option value="{{ $emergencia->id }}">{{ $emergencia->id }} - {{ $emergencia->nombre }}</option>
        @endforeach
    </select>

    @error('categoria_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>