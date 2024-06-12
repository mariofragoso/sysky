@extends('layouts.admin')

@section('titulo', 'Detalles del Empleado')

@section('contenido')

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $empleado->id }}</td>
                        </tr>
                        <tr>
                            <th>Número de Nómina</th>
                            <td>{{ $empleado->numero_nomina }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $empleado->nombre }}</td>
                        </tr>

                        <tr>
                            <th>Apellido Paterno</th>
                            <td>{{ $empleado->apellidoP }}</td>
                        </tr>

                        <tr>
                            <th>Apellido Materno</th>
                            <td>{{ $empleado->apellidoM }}</td>
                        </tr>

                        <tr>
                            <th>Puesto</th>
                            <td>{{ $empleado->puesto }}</td>
                        </tr>
                        <tr>
                            <th>Área</th>
                            <td>{{ $empleado->area }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary">Editar</a>

                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>

                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver a la lista</a>
            </div>
        </div>
    </div>

@endsection
