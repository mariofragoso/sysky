    <h1>Editar Asignación de Accesorio</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asignacionaccesorios.update', $asignacion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="empleado_id">Empleado:</label>
        <select id="empleado_id" name="empleado_id" required>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ $asignacion->empleado_id == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombre }}</option>
            @endforeach
        </select>

        <label for="accesorio_id">Accesorio:</label>
        <select id="accesorio_id" name="accesorio_id" required>
            @foreach ($accesorios as $accesorio)
                <option value="{{ $accesorio->id }}" {{ $asignacion->accesorio_id == $accesorio->id ? 'selected' : '' }}>{{ $accesorio->descripcion }}</option>
            @endforeach
        </select>

        <label for="cantidad_asignada">Cantidad Asignada:</label>
        <input type="number" id="cantidad_asignada" name="cantidad_asignada" value="{{ $asignacion->cantidad_asignada }}" required>

        <label for="fecha_asignacion">Fecha de Asignación:</label>
        <input type="date" id="fecha_asignacion" name="fecha_asignacion" value="{{ $asignacion->fecha_asignacion }}" required>

        <label for="usuario_responsable">Usuario Responsable:</label>
        <select id="usuario_responsable" name="usuario_responsable" required>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $asignacion->usuario_responsable == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
            @endforeach
        </select>

        <label for="ticket">Ticket:</label>
        <input type="number" id="ticket" name="ticket" value="{{ $asignacion->ticket }}" required>

        <label for="nota_descriptiva">Nota Descriptiva:</label>
        <input type="text" id="nota_descriptiva" name="nota_descriptiva" value="{{ $asignacion->nota_descriptiva }}">

        <button type="submit">Guardar</button>
    </form>
