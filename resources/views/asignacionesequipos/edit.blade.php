    <h1>Editar Asignación de Equipo</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asignacionesequipos.update', $asignacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="empleado_id">Empleado:</label>
        <select id="empleado_id" name="empleado_id" required>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}" {{ $asignacion->empleado_id == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombre }}</option>
            @endforeach
        </select>

        <label for="equipo_id">Equipo:</label>
        <select id="equipo_id" name="equipo_id" required>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}" {{ $asignacion->equipo_id == $equipo->id ? 'selected' : '' }}>{{ $equipo->numero_serie }}</option>
            @endforeach
        </select>

        <label for="fecha_asignacion">Fecha de Asignación:</label>
        <input type="date" id="fecha_asignacion" name="fecha_asignacion" value="{{ $asignacion->fecha_asignacion }}" required>

        <label for="usuario_responsable">Usuario Responsable:</label>
        <select id="usuario_responsable" name="usuario_responsable" required>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $asignacion->usuario_responsable == $usuario->id ? 'selected' : '' }}>{{ $usuario->usuario }}</option>
            @endforeach
        </select>

        <label for="ticket">Ticket:</label>
        <input type="number" id="ticket" name="ticket" value="{{ $asignacion->ticket }}" required>

        <label for="nota_descriptiva">Nota Descriptiva:</label>
        <input type="text" id="nota_descriptiva" name="nota_descriptiva" value="{{ $asignacion->nota_descriptiva }}">

        <label for="empresa_id">Empresa:</label>
        <select id="empresa_id" name="empresa_id" required>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}" {{ $asignacion->empresa_id == $empresa->id ? 'selected' : '' }}>{{ $empresa->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Guardar</button>
    </form>
