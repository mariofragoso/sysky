@extends('layouts.admin')

@section('titulo', 'Equipos Dados de Baja')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">

            <!-- Barra de búsqueda -->
            <form action="{{ route('equipos.baja') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por Número de Serie o Etiqueta Skytex" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de equipos -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
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
                    @forelse ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->numero_serie }}</td>
                            <td>{{ optional($equipo->marca)->nombre ?? '' }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->etiqueta_skytex }}</td>
                            <td>{{ optional($equipo->tipoEquipo)->nombre ?? '' }}</td>
                            <td>{{ $equipo->estado }}</td>
                            <td>
                                <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-warning">Editar</a>
                                <form hidden action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este equipo?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron equipos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $equipos->links() }}
        </div>
    </div>
@endsection
