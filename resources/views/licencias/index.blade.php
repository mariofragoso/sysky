@extends('layouts.admin')

@section('titulo', 'Licencias')

@section('contenido')
    <a href="{{ route('licencias.create') }}" class="btn btn-primary">Agregar Nueva Licencia</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha Adquisición</th>
                <th>Frecuencia de Pago</th>
                <th>Próximo Pago</th>
                <th>Estado</th>
                <th>Usuario responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licencias as $licencia)
                <tr>
                    <td>{{ $licencia->nombre }}</td>
                    <td>{{ $licencia->tipoLicencia->nombre }}</td>
                    <td>{{ $licencia->fecha_adquisicion }}</td>
                    <td>{{ ucfirst($licencia->frecuencia_pago) }}</td>
                    <td>{{ $licencia->fecha_siguiente_pago }}</td>
                    <td>{{ ucfirst($licencia->estado) }}</td>
                    <td>{{ $licencia->usuario->name ?? 'No asignado' }}</td> <!-- Mostrar el nombre del usuario -->
                    <td>
                        <a href="{{ route('licencias.show', $licencia->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('licencias.edit', $licencia->id) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
