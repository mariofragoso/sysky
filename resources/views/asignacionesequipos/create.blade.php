@extends('layouts.admin')

@section('titulo', 'Crear Nueva Asignación de Equipo')

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

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <form action="{{ route('asignacionesequipos.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label for="empleado_id" class="form-label">Empleado:</label>
                        <select id="empleado_id" name="empleado_id" class="form-control" required>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="equipo_id" class="form-label">Equipo:</label>
                        <select id="equipo_id" name="equipo_id" class="form-control" required>
                            @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id }}">{{ $equipo->etiqueta_skytex }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="fecha_asignacion" class="form-label">Fecha de Asignación:</label>
                        <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="usuario_responsable" class="form-label">Usuario Responsable:</label>
                        <select id="usuario_responsable" name="usuario_responsable" class="form-control" required>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="ticket" class="form-label">Ticket:</label>
                        <input type="number" class="form-control" id="ticket" name="ticket" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="nota_descriptiva" class="form-label">Nota Descriptiva:</label>
                        <input type="text" class="form-control" id="nota_descriptiva" name="nota_descriptiva" required>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="empresa_id" class="form-label">Empresa:</label>
                        <select id="empresa_id" name="empresa_id" class="form-control" required>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="asignado">Asignado</option>
                            <option value="no asignado">No Asignado</option>
                            <option value="prestamo">Préstamo</option>
                            <option value="baja">Baja</option>
                        </select>
                        <div class="valid-feedback">
                            Good!
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
