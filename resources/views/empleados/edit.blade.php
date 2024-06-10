
    <h1>Editar Empleado</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="numero_nomina">Número de Nómina:</label>
        <input type="text" id="numero_nomina" name="numero_nomina" value="{{ $empleado->numero_nomina }}" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>

        <label for="apellidoP">Apellido Paterno:</label>
        <input type="text" id="apellidoP" name="apellidoP" value="{{ $empleado->nombre }}" required>

        <label for="apellidoM">Apellido Materno:</label>
        <input type="text" id="apellidoM" name="apellidoM" value="{{ $empleado->nombre }}" required>

        <label for="puesto">Puesto:</label>
        <input type="text" id="puesto" name="puesto" value="{{ $empleado->puesto }}" required>

        <label for="area">Área:</label>
        <input type="text" id="area" name="area" value="{{ $empleado->area }}" required>

        <button type="submit">Actualizar</button>
    </form>
