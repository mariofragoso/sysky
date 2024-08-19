<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pase de Salida para Equipo de Cómputo | {{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}</title>
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
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            font-size: 10px;
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
        <h1 class="title">Pase de Salida para Equipo de Cómputo</h1>
    </div>
    
    <div class="section">
        <table>
            <tr>
                <td><strong>Folio:</strong> {{ $folio }}</td>
                <td><strong>Fecha:</strong> {{ $fecha }}</td>
            </tr>
            <tr>
                <td><strong>Nómina:</strong> {{ $empleado->numero_nomina }}</td>
                <td><strong>Departamento:</strong> {{ $empleado->area }}</td>
            </tr>
            <tr>
                <td><strong>Área:</strong> {{ $empleado->area }}</td>
                <td>
                    <strong>INGRESA ( )</strong>
                    <strong>SALE ( @if($tipo_movimiento == 'salida') X @endif )</strong>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h3>Equipo de Cómputo</h3>
        <table>
            <tr>
                <th>Partida</th>
                <th>Cantidad</th>
                <th>Descripción (Incluye modelo y/o etiqueta SKYTEX)</th>
                <th>Número de Serie</th>
            </tr>
            @foreach($equipos as $index => $equipo)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>1</td>
                <td>{{ $equipo->tipo }} {{ $equipo->marca }} {{ $equipo->modelo }} Etq: {{ $equipo->etiqueta_skytex }}</td>
                <td>{{ $equipo->numero_serie }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    
    <div class="section">
        <p><strong>Fecha de Salida:</strong> {{ $fecha_salida }}</p>
        <p><strong>Fecha de Entrada:</strong> {{ $fecha_entrada }}</p>
        <p><strong>Motivo de la Salida/Entrada:</strong> {{ $motivo }}</p>
    </div>
    
    <div class="section footer">
        <p>
            NOTA: Este pase de salida solo es válido por 3 meses. Transcurrido este tiempo deberán tramitar uno nuevo.
        </p>
    </div>
    
    <div class="section">
        <div class="signatures">
            <div class="signature">
                <div class="signature-line"></div>
                <p>Víctor Méndez Hdez<br>Gerente de Infraestructura TI</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $usuario->name }}<br>Autoriza</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>{{ $empleado->nombre }} {{ $empleado->apellidoP }} {{ $empleado->apellidoM }}<br>Empleado</p>
            </div>
        </div>
    </div>
</body>
</html>