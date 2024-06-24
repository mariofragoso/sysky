@extends('layouts.admin')

@section('titulo', 'Lista de Asignaciones de Equipos')

@section('contenido')
    <div>
        <a href="{{ route('asignacionesequipos.create') }}" class="btn btn-secondary mb-3">Crear Nueva Asignación +</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
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
                                <td>{{ $asignacion->usuario->name }}</td>
                                <td>{{ $asignacion->ticket }}</td>
                                <td>{{ $asignacion->nota_descriptiva }}</td>
                                <td>{{ $asignacion->empresa->nombre }}</td>
                                <td>
                                    <a href="{{ route('asignacionesequipos.show', $asignacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('asignacionesequipos.edit', $asignacion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('asignacionesequipos.destroy', $asignacion->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta asignación?')">Eliminar</button>
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
