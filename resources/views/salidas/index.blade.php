@extends('layouts.admin')

@section('titulo', 'Salidas de equipo')

@section('contenido')

    <div>
        <a href="{{ route('salidas.create') }}" class="btn btn-secondary mb-3">Registrar Nuevo Préstamo +</a>
    </div>
    <form action="{{ route('salidas.index') }}" method="GET" class="mb-4">
        <div class="input-group">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por equipo o empleado..."
                class="form-control me-2">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
            </div>
        </div>


    </form>

    {{-- FORMULARIO PARA PDF MÚLTIPLE --}}
    <form action="{{ route('salidas.generarPDFMultiple') }}" method="POST" target="_blank">
        @csrf
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Generar PDF Seleccionados</button>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
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
                                    <td><input type="checkbox" name="salidas[]" value="{{ $salida->id }}"></td>
                                    <td>{{ $salida->equipo->etiqueta_skytex }}</td>
                                    <td>{{ $salida->empleado->nombre }} {{ $salida->empleado->apellidoP }}
                                        {{ $salida->empleado->apellidoM }}</td>
                                    <td>{{ $salida->fecha_salida }}</td>
                                    <td>{{ $salida->fecha_regreso ?? 'No ha regresado' }}</td>
                                    <td>{{ $salida->usuarioResponsable->name }}</td>
                                    <td>
                                        @if ($salida->imagen)
                                            <img src="{{ asset('images/salidas/' . $salida->imagen) }}"
                                                alt="Imagen de Salida" width="100">
                                        @else
                                            Sin imagen
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('salidas.show', $salida->id) }}"
                                            class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('salidas.edit', array_merge(['salida' => $salida->id], request()->query())) }}"
                                            class="btn btn-warning btn-sm">Registrar Regreso</a>
                                        <a href="{{ route('ruta.generarPDF', $salida->id) }}"
                                            class="btn btn-primary btn-sm" target="_blank">Ver PDF</a>

                                        {{-- MOVER ESTE FORM FUERA DEL OTRO FORM --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $salidas->links() }}
                </div>
            </div>
        </div>
    </form>

    {{-- FORMULARIOS DE ELIMINACIÓN FUERA DEL FORM PRINCIPAL --}}
    @foreach ($salidas as $salida)
        @if (in_array(auth()->id(), [1]))
            <form id="delete-form-{{ $salida->id }}" action="{{ route('salidas.destroy', $salida->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endforeach

    {{-- Botones individuales de eliminación --}}
    <script>
        function eliminarSalida(id) {
            if (confirm('¿Estás seguro de eliminar esta salida?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

    {{-- Botones para eliminar (fuera del <form>) --}}
    <script>
        document.querySelectorAll('table tbody tr').forEach(function(row, index) {
            const id = "{{ $salidas[0]->id ?? '' }}"; // Asegura que hay al menos una salida
            const salida = @json($salidas->pluck('id')); // Todos los IDs

            if (salida[index]) {
                let btn = document.createElement('button');
                btn.innerText = 'Eliminar';
                btn.className = 'btn btn-danger btn-sm';
                btn.type = 'button';
                btn.onclick = () => eliminarSalida(salida[index]);

                row.querySelector('td:last-child').appendChild(btn);
            }
        });
    </script>

@endsection

@push('scripts')
    <script>
        document.getElementById('checkAll').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="salidas[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>
@endpush
