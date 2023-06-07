<div class="table-responsive">
    <table id="" class="table mb-4 contextual-table">
    
        <thead>
            <tr class="table-dark">
                <th class="text-dark">ID</th>
                <th class="text-dark">TÍTULO</th>
                <th class="text-dark">DESCRIPCIÓN</th>
                <th class="text-dark">CATEGORÍA</th>
                <th class="text-dark">SUBCATEGORÍA</th>
            </tr>
        </thead>

        <tbody>
            <tr class="table-primary">
                <td>{{ $incidencia->id }}</td>
                <td>{{ $incidencia->titulo }}</td>
                <td>{{ $incidencia->descripcion }}</td>
                <td>{{ $incidencia->categoria->nombre }} </td>
                <td>{{ $incidencia->subcategoria->nombre }}</td>
            </tr>
        </tbody>

        <thead>
            <tr class="table-dark">
                <th class="text-dark">PRIORIDAD</th>
                <th class="text-dark">STATUS</th>
                <th class="text-dark">ASIGNADO A</th>
                <th class="text-dark">CREADO</th>
                <th class="text-dark">ACTUALIZADO</th>
            </tr>
        </thead>

        <tbody>
            <tr class="table-primary">
                <td>{{ $incidencia->emergencia->nombre }}</td>
                <td>{{ $incidencia->statu->nombre }}</td>
                <td>{{ $incidencia->asignado_id != null ? $incidencia->asignado->nombre : 'Sin asignar' }} </td>
                <td>{{ $incidencia->created_at }}</td>
                <td>{{ $incidencia->updated_at }}</td>
            </tr>
        </tbody>
        
    </table>
</div>