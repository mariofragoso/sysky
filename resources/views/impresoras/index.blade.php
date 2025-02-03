@extends('layouts.admin')

@section('titulo', 'Listado de Impresoras')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Listado de Impresoras</h1>
        <a href="{{ route('impresoras.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Agregar Nueva Impresora
        </a>
    </div>

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> Se encontraron errores:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabla de impresoras -->
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>IP</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($impresoras as $impresora)
                <tr>
                    <td>{{ $impresora->nombre }}</td>
                    <td>{{ $impresora->ip }}</td>
                    <td>{{ $impresora->marca }}</td>
                    <td>{{ $impresora->modelo }}</td>
                    <td>{{ $impresora->area }}</td>
                    <td id="estado-{{ $impresora->id }}">
                        <span class="badge {{ $impresora->estado == 'En línea' ? 'bg-success' : 'bg-danger' }}">
                            {{ $impresora->estado }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('impresoras.show', $impresora->id) }}" class="btn btn-info btn-sm me-2">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('impresoras.edit', $impresora->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('impresoras.destroy', $impresora->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta impresora?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay impresoras registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    function actualizarEstados() {
        fetch('{{ route('impresoras.estados') }}')
            .then(response => {
                if (!response.ok) throw new Error('Error en la respuesta del servidor');
                return response.json();
            })
            .then(data => {
                data.forEach(impresora => {
                    const estadoCelda = document.getElementById(`estado-${impresora.id}`);
                    if (estadoCelda) {
                        const badge = estadoCelda.querySelector('span');
                        badge.textContent = impresora.estado;
                        badge.className = 'badge'; // Reset class
                        badge.classList.add(impresora.estado === 'En línea' ? 'bg-success' : 'bg-danger');
                        badge.setAttribute('aria-label', `Estado de la impresora: ${impresora.estado}`);
                    }
                });
            })
            .catch(error => {
                console.error('Error al actualizar estados:', error);
                mostrarToast('Error', 'Hubo un problema al actualizar los estados de las impresoras.', 'bg-danger');
            });
    }

    function mostrarToast(titulo, mensaje, clase) {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white ${clase} border-0`;
        toast.role = 'alert';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${titulo}:</strong> ${mensaje}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        toast.addEventListener('hidden.bs.toast', () => toast.remove());
    }

    document.addEventListener('DOMContentLoaded', () => {
        actualizarEstados();
        setInterval(actualizarEstados, 30000); // Actualizar cada 30 segundos
    });
</script>
@endsection
