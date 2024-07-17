@extends('layouts.admin')

@section('titulo', 'Acciones Registradas')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <h5 class="card-title">Acciones Registradas</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Módulo</th>
                        <th>Descripción</th>
                        <th>Usuario Responsable</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acciones as $accion)
                        <tr>
                            <td>{{ $accion->id }}</td>
                            <td>{{ $accion->modulo }}</td>
                            <td>{{ $accion->descripcion }}</td>
                            <td>{{ $accion->usuario->name ?? 'N/A' }}</td>
                            <td>{{ $accion->fechahora }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
