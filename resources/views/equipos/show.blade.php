    <h1>Detalles del Equipo</h1>
    <p>ID: {{ $equipo->id }}</p>
    <p>Número de Serie: {{ $equipo->numero_serie }}</p>
    <p>Marca: {{ $equipo->marca }}</p>
    <p>Modelo: {{ $equipo->modelo }}</p>
    <p>Etiqueta Skytex: {{ $equipo->etiqueta_skytex }}</p>
    <p>Tipo: {{ $equipo->tipo }}</p>
    <p>Estado: {{ $equipo->estado }}</p>
    <a href="{{ route('equipos.edit', $equipo->id) }}">Editar</a>
    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('equipos.index') }}">Volver a la lista</a>
