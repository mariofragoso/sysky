@extends('layouts.admin')

@section('titulo', 'Lista de Equipos')

@section('contenido')

    <div>
        <a href="{{ route('equipos.create') }}" class="btn btn-secondary mb-3">Agregar Nuevo Equipo + </a>
    </div>



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
                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este Equipo?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
