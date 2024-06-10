    <h1>Detalles del Empleado</h1>
    <p>ID: {{ $empleado->id }}</p>
    <p>Número de Nómina: {{ $empleado->numero_nomina }}</p>
    <p>Nombre: {{ $empleado->nombre }}</p>
    <p>Puesto: {{ $empleado->puesto }}</p>
    <p>Área: {{ $empleado->area }}</p>
    <a href="{{ route('empleados.edit', $empleado->id) }}">Editar</a>
    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
    <a href="{{ route('empleados.index') }}">Volver a la lista</a>
