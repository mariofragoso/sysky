    <h1>Detalles de la Asignación de Accesorio</h1>

    <ul>
        <li><strong>ID:</strong> {{ $asignacion->id }}</li>
        <li><strong>Empleado:</strong> {{ $asignacion->empleado->nombre }}</li>
        <li><strong>Accesorio:</strong> {{ $asignacion->accesorio->descripcion }}</li>
        <li><strong>Cantidad Asignada:</strong> {{ $asignacion->cantidad_asignada }}</li>
        <li><strong>Fecha de Asignación:</strong> {{ $asignacion->fecha_asignacion }}</li>
        <li><strong>Usuario Responsable:</strong> {{ $asignacion->usuario->name }}</li>
        <li><strong>Ticket:</strong> {{ $asignacion->ticket }}</li>
        <li><strong>Nota Descriptiva:</strong> {{ $asignacion->nota_descriptiva }}</li>
    </ul>

    <a href="{{ route('asignacionaccesorios.index') }}">Volver</a>
