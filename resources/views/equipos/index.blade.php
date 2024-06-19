@extends('layouts.admin')

@section('titulo', 'Lista de Equipos')

@section('contenido')

    <div>
        <a href="{{ route('equipos.create') }}" class="btn btn-secondary mb-3">Agregar Nuevo Equipo + </a>
    </div>

    <!-- Barra de búsqueda -->
    <form action="{{ route('equipos.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por número de Serie o Etiqueta Skytex"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>



    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número de Serie</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Etiqueta Skytex</th>
                            <th>Tipo</th>
                            <th>Orden De Compra</th>
                            <th>Requisicion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->id }}</td>
                                <td>{{ $equipo->numero_serie }}</td>
                                <td>{{ $equipo->marca }}</td>
                                <td>{{ $equipo->modelo }}</td>
                                <td>{{ $equipo->etiqueta_skytex }}</td>
                                <td>{{ $equipo->tipo }}</td>
                                <td>{{ $equipo->orden_compra }}</td>
                                <td>{{ $equipo->requisicion }}</td>
                                <td>{{ $equipo->estado }}</td>
                                <td>
                                    <a
                                        href="{{ route('equipos.show', $equipo->id) }}"class="btn btn-primary btn-sm">Ver</a>
                                    <a href="{{ route('equipos.edit', $equipo->id) }}"class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este Equipo?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No se encontraron Equipos</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $equipos->appends(['search' => request('search')])->links() }}
    </div>
@endsection
