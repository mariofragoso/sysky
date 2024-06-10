
    <h1>Lista de Asignaciones de Accesorios</h1>
    <a href="{{ route('asignacionaccesorios.create') }}">Crear Nueva Asignación</a>

    @if ($message = Session::get('success'))
        <div>
            {{ $message }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Accesorio</th>
                <th>Cantidad Asignada</th>
                <th>Fecha de Asignación</th>
                <th>Usuario Responsable</th>
                <th>Ticket</th>
                <th>Nota Descriptiva</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignacionesaccesorios as $asignacion)
                <tr>
                    <td>{{ $asignacion->id }}</td>
                    <td>{{ $asignacion->empleado->nombre }}</td>
                    <td>{{ $asignacion->accesorio->descripcion }}</td>
                    <td>{{ $asignacion->cantidad_asignada }}</td>
                    <td>{{ $asignacion->fecha_asignacion }}</td>
                    <td>{{ $asignacion->usuario->name }}</td>
                    <td>{{ $asignacion->ticket }}</td>
                    <td>{{ $asignacion->nota_descriptiva }}</td>
                    <td>
                        <a href="{{ route('asignacionaccesorios.show', $asignacion->id) }}">Ver</a>
                        <a href="{{ route('asignacionaccesorios.edit', $asignacion->id) }}">Editar</a>
                        <form action="{{ route('asignacionaccesorios.destroy', $asignacion->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

