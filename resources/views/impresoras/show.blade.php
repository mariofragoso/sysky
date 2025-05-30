@extends('layouts.admin')

@section('titulo', 'Detalle de la Impresora')

@section('contenido')

    <div class="card shadow-lg p-3 mb-5 bg-white rounded mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Modelo</th>
                    <td>{{ $impresora->modelo }}</td>
                </tr>
                <tr>
                    <th>Marca</th>
                    <td>{{ $impresora->marca }}</td>
                </tr>
                <tr>
                    <th>Área</th>
                    <td>{{ $impresora->area }}</td>
                </tr>
                <tr>
                    <th>Dirección IP</th>
                    <td>{{ $impresora->ip }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>
                        @if($impresora->en_linea)
                            <span class="badge bg-success">En línea</span>
                        @else
                            <span class="badge bg-danger">Fuera de línea</span>
                        @endif
                    </td>
                </tr>
                
            </table>

            <a href="{{ route('impresoras.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('impresoras.edit', $impresora->id) }}" class="btn btn-primary">Editar</a>

            @if (in_array(auth()->id(), [1]))
                <form action="{{ route('impresoras.destroy', $impresora->id) }}" method="POST"
                      style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Está seguro de que desea eliminar esta impresora?')">
                        Eliminar
                    </button>
                </form>
            @endif
        </div>
    </div>

@endsection
