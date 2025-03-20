@extends('layouts.admin')

@section('titulo', 'Detalle del Equipo')

@section('contenido')

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Número de Serie</th>
                    <td>{{ $equipo->numero_serie }}</td>
                </tr>

                <tr>
                    <th> Marca </th>
                    <td>{{ $equipo->marca->nombre ?? 'Sin Marca' }}</td>
                </tr>
                <tr>
                    <th>Modelo</th>
                    <td>{{ $equipo->modelo }}</td>
                </tr>
                <tr>
                    <th>Etiqueta Skytex</th>
                    <td>{{ $equipo->etiqueta_skytex }}</td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td> {{ $equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}</td>
                </tr>
                <tr>
                    <th>Orden de Compra</th>
                    <td>{{ $equipo->orden_compra }}</td>
                </tr>
                <tr>
                    <th>Requisición</th>
                    <td>{{ $equipo->requisicion }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $equipo->estado }}</td>
                </tr>
                <tr>
                    <th>Empleado Asignado</th>
                    <td>{{ $equipo->asignacionActual->empleado->nombre ?? 'No Asignado' }}
                        {{ $equipo->asignacionActual->empleado->apellidoP ?? '' }}
                        {{ $equipo->asignacionActual->empleado->apellidoM ?? '' }}</td>
                </tr>





            </table>

            <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary">Editar</a>

            @if (in_array(auth()->id(), [1]))
                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Está seguro de que desea eliminar este equipo?')">Eliminar</button>
                </form>
            @endif
        </div>
    </div>

@endsection
