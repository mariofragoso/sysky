@extends('layouts.admin')

@section('titulo', 'Editar Empleado')

@section('contenido')

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="numero_serie">Número de Serie:</label>
        <input type="text" id="numero_serie" name="numero_serie" value="{{ $equipo->numero_serie }}" required>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="{{ $equipo->marca }}" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="{{ $equipo->modelo }}" required>

        <label for="etiqueta_skytex">Etiqueta Skytex:</label>
        <input type="text" id="etiqueta_skytex" name="etiqueta_skytex" value="{{ $equipo->etiqueta_skytex }}" required>

        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="{{ $equipo->tipo }}" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Asignado" {{ $equipo->estado == 'Asignado' ? 'selected' : '' }}>Asignado</option>
            <option value="No asignado" {{ $equipo->estado == 'No asignado' ? 'selected' : '' }}>No asignado</option>
            <option value="Baja" {{ $equipo->estado == 'Baja' ? 'selected' : '' }}>Baja</option>
        </select>

        <button type="submit">Actualizar</button>
    </form>
@endsection
