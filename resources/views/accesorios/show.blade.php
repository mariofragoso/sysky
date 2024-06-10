
    <h1>Detalles del Accesorio</h1>
    <p>ID: {{ $accesorio->id }}</p>
    <p>Descripción: {{ $accesorio->descripcion }}</p>
    <p>Marca: {{ $accesorio->marca }}</p>
    <p>Modelo: {{ $accesorio->modelo }}</p>
    <p>Cantidad: {{ $accesorio->cantidad }}</p>
    <p>Orden de Compra: {{ $accesorio->orden_compra_acc }}</p>
    <p>Requisición: {{ $accesorio->requisicion }}</p>
    <a href="{{ route('accesorios.edit', $accesorio->id) }}">Editar</a>
    <form action="{{ route('accesorios.destroy', $accesorio->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('accesorios.index') }}">Volver a la lista</a>
