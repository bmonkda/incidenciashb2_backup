<div class="table-responsive">
    <table id="zero-config" class="table mb-4 contextual-table">
    
        <thead>
            <tr>
                <th>ID</th>
                <th>TÍTULO</th>
                <th>DESCRIPCIÓN</th>
                <th>CATEGORÍA</th>
                <th>SUBCATEGORÍA</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $incidencia->id }}</td>
                <td>{{ $incidencia->titulo }}</td>
                <td>{{ $incidencia->descripcion }}</td>
                <td>{{ $incidencia->categoria->nombre }} </td>
                <td>{{ $incidencia->subcategoria->nombre }}</td>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th>PRIORIDAD</th>
                <th>STATUS</th>
                <th>ASIGNADO A</th>
                <th>CREADO</th>
                <th>ACTUALIZADO</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $incidencia->emergencia->nombre }}</td>
                <td>{{ $incidencia->statu->nombre }}</td>
                <td>{{ $incidencia->asignado_id != null ? $incidencia->asignado->nombre : 'Sin asignar' }} </td>
                <td>{{ $incidencia->created_at }}</td>
                <td>{{ $incidencia->updated_at }}</td>
            </tr>
        </tbody>
        
    </table>
</div>