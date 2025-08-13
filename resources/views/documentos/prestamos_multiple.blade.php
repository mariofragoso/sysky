<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Préstamo de Equipo | {{ $prestamos->first()->empleado->nombre }}
        {{ $prestamos->first()->empleado->apellidoP }} {{ $prestamos->first()->empleado->apellidoM }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                line-height: 1.4;
                margin: 0;
                padding: 20px;
            }
    
            .header {
                width: 100%;
                margin-bottom: 20px;
            }
    
            .logo {
                width: 150px;
                display: inline-block;
                vertical-align: middle;
            }
    
            .title {
                display: inline-block;
                vertical-align: middle;
                font-size: 18px;
                font-weight: bold;
                margin-left: 20px;
            }
    
            .section {
                border: 1px solid #ffffff;
                padding: 10px;
                margin-bottom: 20px;
            }
    
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }
    
            th,
            td {
                border: 1px solid #000;
                padding: 5px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            .footer {
                font-size: 8px;
                text-align: justify;
            }
    
            .signatures {
                margin-top: 30px;
            }
    
            .signature {
                display: inline-block;
                width: 32%;
                text-align: center;
                vertical-align: top;
            }
    
            .signature-line {
                border-top: 1px solid #000;
                margin-top: 40px;
                margin-bottom: 5px;
            }
        </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('libs/img/logo_skytex.png') }}" alt="Skytex Logo" class="logo">
        <h1 class="title">Préstamo de Equipo de Cómputo</h1>
        <p style="float: right; width: 10%">
            <font color="#ff0000">Folio: {{ $prestamos->first()->id }}</font>
        </p>
    </div>

    <div class="section">
        <table>
            <tr>
                <td><strong>Nombre de empleado:</strong> {{ $prestamos->first()->empleado->nombre }}
                    {{ $prestamos->first()->empleado->apellidoP }} {{ $prestamos->first()->empleado->apellidoM }}</td>
                <td><strong>Fecha de Préstamo:</strong> {{ $prestamos->first()->fecha_prestamo }}</td>
            </tr>
            <tr>
                <td><strong>Nómina:</strong> {{ $prestamos->first()->empleado->numero_nomina }}</td>
                <td><strong>Departamento:</strong> {{ $prestamos->first()->empleado->area }}</td>
            </tr>
            <tr>
                <td><strong>Cargo:</strong> {{ $prestamos->first()->empleado->puesto }}</td>
                <td><strong>Área:</strong> {{ $prestamos->first()->empleado->area }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3 style="text-align: center">Equipos en Préstamo</h3>
        <table>
            <tr>
                <th>Partida</th>
                <th>cantidad</th>
                <th>Descripción (Incluye modelo y/o etiqueta SKYTEX)</th>
                <th>Número de Serie</th>
            </tr>
            @foreach ($prestamos as $key => $prestamo)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>1</td>
                    <td>{{ $prestamo->equipo->tipoEquipo->nombre ?? 'Sin Tipo' }}
                        {{ $prestamo->equipo->marca->nombre ?? 'Sin Marca' }} {{ $prestamo->equipo->modelo }} Etq:
                        {{ $prestamo->equipo->etiqueta_skytex }}</td>
                    <td>{{ $prestamo->equipo->numero_serie }}</td>

                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table>
            <tr>
                <td><strong>Observaciones:</strong> {{ $prestamo->nota_prestamo ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <p><strong>Fecha de Préstamo:</strong> {{ $prestamo->fecha_prestamo }}</p>
        <p><strong>Fecha de Regreso:</strong> {{ $prestamo->fecha_regreso }}</p>
    </div>

    <div class="section">
        <div class="signatures">
            <div class="signature">
                <div class="signature-line"></div>
                <p>Víctor Méndez Hdez<br>Gerente de Infraestructura TI</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $prestamos->first()->usuario->name ?? 'N/A' }}<br>Entrega</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $prestamos->first()->empleado->nombre }} {{ $prestamos->first()->empleado->apellidoP }}
                    {{ $prestamos->first()->empleado->apellidoM }}<br>Recibe</p>
            </div>

            <div class="section footer">
                <p style="text-align: center">
                    <strong>Este pase de préstamo es válido hasta la fecha de regreso especificada.</strong>
                </p>
            </div>

        </div>
    </div>
</body>

</html>
