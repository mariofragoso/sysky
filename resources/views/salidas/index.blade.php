@extends('layouts.admin')

@section('titulo', 'Salidas de equipo')

@section('contenido')

    <div>
        <a href="{{ route('salidas.create') }}" class="btn btn-primary mb-3">Registrar Nueva Salida</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Empleado</th>
                            <th>Fecha de Salida</th>
                            <th>Fecha de Regreso</th>
                            <th>Usuario Responsable</th>
                            <th>Imagen</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salidas as $salida)
                            <tr>
                                <td>{{ $salida->id }}</td>
                                <td>{{ $salida->equipo->etiqueta_skytex }}</td>
                                <td>{{ $salida->empleado->nombre }} {{ $salida->empleado->apellidoP }}
                                    {{ $salida->empleado->apellidoM }}</td>
                                <td>{{ $salida->fecha_salida }}</td>
                                <td>{{ $salida->fecha_regreso ?? 'No ha regresado' }}</td>
                                <td>{{ $salida->usuarioResponsable->name }}</td>
                                <td>
                                    @if ($salida->imagen)
                                        <img src="{{ asset('images/salidas/' . $salida->imagen) }}" alt="Imagen de Salida"
                                            width="100">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('salidas.show', $salida->id) }}" class="btn btn-info">Ver
                                        Detalles</a>
                                    <a href="{{ route('salidas.edit', $salida->id) }}" class="btn btn-warning">Registrar
                                        Regreso</a>
                                        <a href="{{ route('ruta.generarPDF', $salida->id) }}" class="btn btn-primary">Generar PDF</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $salidas->links() }}
            </div>
        </div>
    </div>
@endsection
