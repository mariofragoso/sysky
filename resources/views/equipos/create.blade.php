    <h1>Crear Nuevo Equipo</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipos.store') }}" method="POST">
        @csrf
        <label for="numero_serie">Número de Serie:</label>
        <input type="text" id="numero_serie" name="numero_serie" required>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>

        <label for="etiqueta_skytex">Etiqueta Skytex:</label>
        <input type="text" id="etiqueta_skytex" name="etiqueta_skytex" required>

        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="Asignado">Asignado</option>
            <option value="No asignado">No asignado</option>
            <option value="Baja">Baja</option>
        </select>

        <button type="submit">Crear</button>
    </form>
