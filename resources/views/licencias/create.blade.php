@extends('layouts.admin')

@section('titulo', 'Crear Nueva Licencia')

@section('contenido')
    <form action="{{ route('licencias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo_licencia_id" class="form-label">Tipo de Licencia</label>
            <select name="tipo_licencia_id" id="tipo_licencia_id" class="form-select select2">
                <option value="">Selecciona un tipo de licencia</option>
                @foreach ($tiposLicencias as $tipoLicencia)
                    <option value="{{ $tipoLicencia->id }}">{{ $tipoLicencia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de Adquisición</label>
            <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
        </div>

        <div class="mb-3">
            <label for="frecuencia_pago" class="form-label">Frecuencia de Pago</label>
            <select name="frecuencia_pago" id="frecuencia_pago" class="form-select select2">
                <option value="mensual">Mensual</option>
                <option value="semestral">Semestral</option>
                <option value="anual">Anual</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_siguiente_pago" class="form-label">Fecha del Siguiente Pago</label>
            <input type="date" class="form-control" id="fecha_siguiente_pago" name="fecha_siguiente_pago" required>
        </div>

        <div class="form-group">
            <label for="fecha_recordatorio">Fecha de Recordatorio</label>
            <input type="date" name="fecha_recordatorio" id="fecha_recordatorio" class="form-control"
                value="{{ old('fecha_recordatorio', $licencia->fecha_recordatorio ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select select2">
                <option value="activa">Activa</option>
                <option value="vencida">Vencida</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection

@section('scripts')
    <!-- Incluye Select2 CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Inicializar Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Selecciona una opción",
                allowClear: true
            });
        });
    </script>
@endsection
