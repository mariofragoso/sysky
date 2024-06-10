    <h1>Lista de Asignaciones de Equipos</h1>
    <a href="{{ route('asignacionesequipos.create') }}">Crear Nueva Asignación</a>

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
                <th>Equipo</th>
                <th>Fecha de Asignación</th>
                <th>Usuario Responsable</th>
                <th>Ticket</th>
                <th>Nota Descriptiva</th>
                <th>Empresa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignacionesequipos as $asignacion)
                <tr>
                    <td>{{ $asignacion->id }}</td>
                    <td>{{ $asignacion->empleado->nombre }}</td>
                    <td>{{ $asignacion->equipo->numero_serie }}</td>
                    <td>{{ $asignacion->fecha_asignacion }}</td>
                    <td>{{ $asignacion->usuario->name }}</td> <!-- Cambio aquí -->
                    <td>{{ $asignacion->ticket }}</td>
                    <td>{{ $asignacion->nota_descriptiva }}</td>
                    <td>{{ $asignacion->empresa->nombre }}</td>
                    <td>
                        <a href="{{ route('asignacionesequipos.show', $asignacion->id) }}">Ver</a>
                        <a href="{{ route('asignacionesequipos.edit', $asignacion->id) }}">Editar</a>
                        <form action="{{ route('asignacionesequipos.destroy', $asignacion->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
