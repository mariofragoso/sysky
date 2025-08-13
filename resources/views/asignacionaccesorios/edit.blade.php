@extends('layouts.admin')

@section('titulo', 'Editar Asignación de Accesorio')

@section('contenido')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <form action="{{ route('asignacionaccesorios.update', $asignacion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3">
                        <label for="empleado_id" class="form-label">Empleado:</label>
                        <select id="empleado_id" name="empleado_id" class="form-control" required>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ $asignacion->empleado_id == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="accesorio_id" class="form-label">Accesorio:</label>
                        <select id="accesorio_id" name="accesorio_id" class="form-control" required>
                            @foreach ($accesorios as $accesorio)
                                <option value="{{ $accesorio->id }}" {{ $asignacion->accesorio_id == $accesorio->id ? 'selected' : '' }}>{{ $accesorio->descripcion }} - {{ $accesorio->marca }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="cantidad_asignada" class="form-label">Cantidad Asignada:</label>
                        <input type="number" id="cantidad_asignada" name="cantidad_asignada" class="form-control" value="{{ $asignacion->cantidad_asignada }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                        <input type="date" id="fecha_asignacion" name="fecha_asignacion" class="form-control" value="{{ $asignacion->fecha_asignacion }}" required>
                    </div>


                    <div class="col-md-3">
                        <label for="ticket" class="form-label">Ticket:</label>
                        <input type="number" id="ticket" name="ticket" class="form-control" value="{{ $asignacion->ticket }}" required>
                    </div>

                    <div class="col-md-12">
                        <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                        <input type="text" id="nota_descriptiva" name="nota_descriptiva" class="form-control" value="{{ $asignacion->nota_descriptiva }}">
                    </div>

                </div>

                <div class="col-12 md-3 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
