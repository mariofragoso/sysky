@extends('layouts.admin')

@section('titulo', 'Lista de Asignaciones de Accesorios')

@section('contenido')
    <div>
        <a href="{{ route('asignacionaccesorios.create') }}" class="btn btn-secondary mb-3">Crear Nueva Asignación +</a>
    </div>

    <form action="{{ route('empleados.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por número de nómina o nombre"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
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
                                    <a href="{{ route('asignacionaccesorios.show', $asignacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('asignacionaccesorios.edit', $asignacion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('asignacionaccesorios.destroy', $asignacion->id) }}" method="POST" style="display:inline">
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

    <!-- Paginación -->
    
    
@endsection
