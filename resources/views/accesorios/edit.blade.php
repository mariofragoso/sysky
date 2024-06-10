    <h1>Editar Accesorio</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('accesorios.update', $accesorio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="{{ $accesorio->descripcion }}" required>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="{{ $accesorio->marca }}" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="{{ $accesorio->modelo }}" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="{{ $accesorio->cantidad }}" required>

        <label for="orden_compra_acc">Orden de Compra:</label>
        <input type="text" id="orden_compra_acc" name="orden_compra_acc" value="{{ $accesorio->orden_compra_acc }}">

        <label for="requisicion">Requisición:</label>
        <input type="text" id="requisicion" name="requisicion" value="{{ $accesorio->requisicion }}">

        <button type="submit">Actualizar</button>
    </form>

