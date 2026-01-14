@extends('layouts.admin')

@section('titulo', 'Registrar Impresora')

@section('contenido')

<div class="card shadow-lg p-4 mb-5 bg-white rounded">
    <div class="card-body">
        <h3 class="mb-4">Registrar Impresora</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('impresoras.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ old('marca') }}" required>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}" required>
            </div>

            <div class="mb-3">
                <label for="area" class="form-label">Área</label>
                <input type="text" name="area" class="form-control" value="{{ old('area') }}" required>
            </div>

            <div class="mb-3">
                <label for="ip" class="form-label">Dirección IP</label>
                <input type="text" name="ip" class="form-control" value="{{ old('ip') }}" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="">-- Selecciona un estado --</option>
                    <option value="En línea" {{ old('estado') == 'En línea' ? 'selected' : '' }}>En línea</option>
                    <option value="Fuera de línea" {{ old('estado') == 'Fuera de línea' ? 'selected' : '' }}>Fuera de línea</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('impresoras.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection
