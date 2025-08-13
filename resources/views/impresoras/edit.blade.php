@extends('layouts.admin')

@section('titulo', 'Editar Impresora')

@section('contenido')
    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <h4 class="mb-4">Editar Impresora</h4>

            <form action="{{ route('impresoras.update', $impresora->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $impresora->nombre }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="modelo">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $impresora->modelo }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $impresora->marca }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="area">Área</label>
                    <input type="text" name="area" class="form-control" value="{{ $impresora->area }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="ip">Dirección IP</label>
                    <input type="text" name="ip" class="form-control" value="{{ $impresora->ip }}" required>
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="en_linea" value="1" class="form-check-input" id="en_linea"
                        {{ $impresora->en_linea ? 'checked' : '' }}>
                    <label class="form-check-label" for="en_linea">¿Está en línea?</label>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('impresoras.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
