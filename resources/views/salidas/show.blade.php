@extends('layouts.admin')

@section('titulo', 'Detalles de la Salida de Equipo')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>ID de Salida:</th>
                    <td>{{ $salida->id }}</td>
                </tr>
                <tr>
                    <th>Empleado:</th>
                    <td>{{ $salida->empleado->nombre ?? 'N/A' }} {{ $salida->empleado->apellidoP ?? 'N/A' }} {{ $salida->empleado->apellidoM ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Equipo:</th>
                    <td>{{ $salida->equipo->tipoEquipo->nombre ?? 'Sin Tipo' }} marca 
                        {{ $salida->equipo->marca->nombre ?? 'Sin Marca' }} con etiqueta 
                        {{ $salida->equipo->etiqueta_skytex ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Salida:</th>
                    <td>{{ $salida->fecha_salida }}</td>
                </tr>
                <tr>
                    <th>Fecha de Regreso:</th>
                    <td>{{ $salida->fecha_regreso ?? 'No ha regresado' }}</td>
                </tr>
                <tr>
                    <th>Nota de Salida:</th>
                    <td>{{ $salida->nota_salida }}</td>
                </tr>
                <tr>
                    <th>Usuario Responsable:</th>
                    <td>{{ $salida->usuarioResponsable->name }}</td>
                </tr>
                <tr>
                    <th>Nota de Regreso:</th>
                    <td>{{ $salida->nota_regreso ?? 'No hay nota de regreso' }}</td>
                </tr>

                @if ($salida->imagen)
                    <tr>
                        <th>Imagen de la Salida:</th>
                        <td>
                            <img src="{{ asset('images/salidas/' . $salida->imagen) }}" alt="Imagen de la salida" class="img-fluid rounded shadow-sm">
                        </td>
                    </tr>
                @endif

                @if ($salida->imagen_regreso)
                    <tr>
                        <th>Imagen del Regreso:</th>
                        <td>
                            <img src="{{ asset('storage/' . $salida->imagen_regreso) }}" alt="Imagen del regreso" class="img-fluid rounded shadow-sm">
                        </td>
                    </tr>
                @endif
            </table>

            <a href="{{ route('salidas.index') }}" class="btn btn-secondary">Volver a la Lista de Salidas</a>

            @if (in_array(auth()->id(), [1]))
                <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de eliminar esta salida?')">Eliminar</button>
                </form>
            @endif
        </div>
    </div>
@endsection
