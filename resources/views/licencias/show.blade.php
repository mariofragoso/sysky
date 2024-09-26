@extends('layouts.admin')

@section('titulo', 'Detalle de la licencia')

@section('contenido')

    <div>
        <strong>Nombre:</strong> {{ $licencias->nombre }}
    </div>
    <div>
        <strong>Tipo de Licencia:</strong> {{ $licencias->tipoLicencia->nombre ?? 'nada' }}
    </div>
    <div>
        <strong>Fecha de Adquisición:</strong> {{ $licencias->fecha_adquisicion }}
    </div>
    <div>
        <strong>Frecuencia de Pago:</strong> {{ ucfirst($licencias->frecuencia_pago) }}
    </div>
    <div>
        <strong>Próximo Pago:</strong> {{ $licencias->fecha_siguiente_pago }}
    </div>
    <div>
        <strong>Recordatorio de pago:</strong> {{ $licencias->fecha_recordatorio }}
    </div>
    <div>
        <strong>Estado:</strong> {{ ucfirst($licencias->estado) }}
    </div>
    <div>
        <strong>Observaciones:</strong> {{ $licencias->observaciones }}
    </div>

    
    <a href="{{ route('licencias.index') }}" class="btn btn-secondary">Regresar</a>
@endsection
