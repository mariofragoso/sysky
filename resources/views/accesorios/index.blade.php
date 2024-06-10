    <h1>Lista de Accesorios</h1>
    <a href="{{ route('accesorios.create') }}">Crear Nuevo Accesorio</a>

    @if ($message = Session::get('success'))
        <div>
            {{ $message }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Cantidad</th>
                <th>Orden de Compra</th>
                <th>Requisición</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accesorios as $accesorio)
                <tr>
                    <td>{{ $accesorio->id }}</td>
                    <td>{{ $accesorio->descripcion }}</td>
                    <td>{{ $accesorio->marca }}</td>
                    <td>{{ $accesorio->modelo }}</td>
                    <td>{{ $accesorio->cantidad }}</td>
                    <td>{{ $accesorio->orden_compra_acc }}</td>
                    <td>{{ $accesorio->requisicion }}</td>
                    <td>
                        <a href="{{ route('accesorios.show', $accesorio->id) }}">Ver</a>
                        <a href="{{ route('accesorios.edit', $accesorio->id) }}">Editar</a>
                        <form action="{{ route('accesorios.destroy', $accesorio->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
