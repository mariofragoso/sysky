@extends('layouts.admin')


@section('contenido')
    <h1>Editar Licencia</h1>

    <form action="{{ route('licencias.update', $licencias->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $licencias->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" class="form-control">
                <option value="licencia" {{ old('tipo', $licencias->tipo) == 'licencia' ? 'selected' : '' }}>Licencia</option>
                <option value="servicio" {{ old('tipo', $licencias->tipo) == 'servicio' ? 'selected' : '' }}>Servicio</option>
                <option value="suscripcion" {{ old('tipo', $licencias->tipo) == 'suscripcion' ? 'selected' : '' }}>Suscripción</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_adquisicion">Fecha de Adquisición</label>
            <input type="date" name="fecha_adquisicion" class="form-control" value="{{ old('fecha_adquisicion', $licencias->fecha_adquisicion) }}" required>
        </div>

        <div class="form-group">
            <label for="frecuencia_pago">Frecuencia de Pago</label>
            <select name="frecuencia_pago" class="form-control">
                <option value="mensual" {{ old('frecuencia_pago', $licencias->frecuencia_pago) == 'mensual' ? 'selected' : '' }}>Mensual</option>
                <option value="anual" {{ old('frecuencia_pago', $licencias->frecuencia_pago) == 'anual' ? 'selected' : '' }}>Anual</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_siguiente_pago">Fecha del Siguiente Pago</label>
            <input type="date" name="fecha_siguiente_pago" class="form-control" value="{{ old('fecha_siguiente_pago', $licencias->fecha_siguiente_pago) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_recordatorio">Fecha de Recordatorio</label>
            <input type="date" name="fecha_recordatorio" class="form-control" value="{{ old('fecha_recordatorio', $licencias->fecha_recordatorio) }}">
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control">
                <option value="activa" {{ old('estado', $licencias->estado) == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="vencida" {{ old('estado', $licencias->estado) == 'vencida' ? 'selected' : '' }}>Vencida</option>
                <option value="cancelada" {{ old('estado', $licencias->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $licencias->observaciones) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
