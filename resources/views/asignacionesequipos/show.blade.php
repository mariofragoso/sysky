@extends('layouts.app')

@section('content')
    <h1>Detalles de la Asignación de Equipo</h1>

    <p>ID: {{ $asignacion->id }}</p>
    <p>Empleado: {{ $asignacion->empleado->nombre }}</p>
    <p>Equipo: {{ $asignacion->equipo->numero_serie }}</p>
    <p>Fecha de Asignación: {{ $asignacion->fecha_asignacion }}</p>
    <p>Usuario Responsable: {{ $asignacion->usuario->name }}</p> <!-- Aquí asegúrate de que 'name' es el campo correcto -->
    <p>Ticket: {{ $asignacion->ticket }}</p>
    <p>Nota Descriptiva: {{ $asignacion->nota_descriptiva }}</p>
    <p>Empresa: {{ $asignacion->empresa->nombre }}</p>
    <a href="{{ route('asignacionesequipos.edit', $asignacion->id) }}">Editar</a>
    <form action="{{ route('asignacionesequipos.destroy', $asignacion->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('asignacionesequipos.index') }}">Volver a la lista</a>
@endsection
