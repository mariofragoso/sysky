    <h1>Crear Nueva Asignación de Equipo</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asignacionesequipos.store') }}" method="POST">
        @csrf
        <label for="empleado_id">Empleado:</label>
        <select id="empleado_id" name="empleado_id" required>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
            @endforeach
        </select>

        <label for="equipo_id">Equipo:</label>
        <select id="equipo_id" name="equipo_id" required>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}">{{ $equipo->etiqueta_skytex }}</option>
            @endforeach
        </select>

        <label for="fecha_asignacion">Fecha de Asignación:</label>
        <input type="date" id="fecha_asignacion" name="fecha_asignacion" required>

        
            <label for="usuario_responsable" class="form-label">Usuario Responsable:</label>
            <select id="usuario_responsable" name="usuario_responsable" class="form-control" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        

        <label for="ticket">Ticket:</label>
        <input type="number" id="ticket" name="ticket" required>

        <label for="nota_descriptiva">Nota Descriptiva:</label>
        <input type="text" id="nota_descriptiva" name="nota_descriptiva">

        <label for="empresa_id">Empresa:</label>
        <select id="empresa_id" name="empresa_id" required>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Guardar</button>
    </form>
