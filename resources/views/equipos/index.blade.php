    <h1>Lista de Equipos</h1>
    <a href="{{ route('equipos.create') }}">Crear Nuevo Equipo</a>

    @if ($message = Session::get('success'))
        <div>
            {{ $message }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Serie</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Etiqueta Skytex</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->id }}</td>
                    <td>{{ $equipo->numero_serie }}</td>
                    <td>{{ $equipo->marca }}</td>
                    <td>{{ $equipo->modelo }}</td>
                    <td>{{ $equipo->etiqueta_skytex }}</td>
                    <td>{{ $equipo->tipo }}</td>
                    <td>{{ $equipo->estado }}</td>
                    <td>
                        <a href="{{ route('equipos.show', $equipo->id) }}">Ver</a>
                        <a href="{{ route('equipos.edit', $equipo->id) }}">Editar</a>
                        <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>