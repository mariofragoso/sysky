@extends('layouts.admin')

@section('titulo', 'Gestión de Respaldos')

@section('contenido')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card-body">
        <h4>Programar Respaldo Automático</h4>
        <form action="{{ route('backups.schedule') }}" method="POST">
            @csrf
            <label>Día de la semana:</label>
            <select name="day" class="form-control">
                <option value="daily">Diario</option>
                <option value="monday">Lunes</option>
                <option value="tuesday">Martes</option>
                <option value="wednesday">Miércoles</option>
                <option value="thursday">Jueves</option>
                <option value="friday">Viernes</option>
                <option value="saturday">Sábado</option>
                <option value="sunday">Domingo</option>
            </select>

            <label>Hora:</label>
            <input type="time" name="time" class="form-control">

            <button type="submit" class="btn btn-primary mt-2">Guardar Configuración</button>
        </form>

        <hr>

        <h4>Respaldos Manuales</h4>
        <form action="{{ route('backups.create') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Respaldar Ahora</button>
        </form>

        <hr>

        <h4>Historial de Respaldos</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ruta</th>
                    <th>Tamaño</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($backups as $backup)
                    <tr>
                        <td>{{ $backup->file_name }}</td>
                        <td>{{ $backup->file_path }}</td>
                        <td>{{ number_format($backup->file_size / 1024, 2) }} KB</td>
                        <td>{{ $backup->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

@endsection
