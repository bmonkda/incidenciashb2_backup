<div class="form-group">
    <label for="titulo">Título:</label>
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

