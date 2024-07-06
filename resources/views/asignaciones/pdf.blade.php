<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de equipo {{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }}
        {{ $asignacion->empleado->apellidoM }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .wrapper {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 5px;
        }

        .logo {
            text-align: left;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .content p {
            margin: 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .footer {
            margin-top: 20px;
        }

        .footer p {
            font-size: 12px;
            text-align: justify;
        }

        .signature-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .signature-section div {
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="https://www.skytexmexico.com/wp-content/uploads/2023/05/skytex-logo-8.png" alt="logo"
                width="90" height="65" />
        </div>
        <div class="header">
            <h1>Formato de Asignación</h1>
        </div>
        <div class="content">
            <p class="full-width"><strong>Recibe:</strong> {{ $asignacion->empleado->nombre }}
                {{ $asignacion->empleado->apellidoP }} {{ $asignacion->empleado->apellidoM }}</p>
            <p class="full-width"><strong>Fecha:</strong> {{ $asignacion->fecha_asignacion }}</p>
            <p><strong>Nómina:</strong> {{$asignacion->empleado->numero_nomina }}</p>
            <p><strong>Departamento:</strong> {{$asignacion->empleado->area }}</p>
            <p><strong>Cargo:</strong> {{$asignacion->empleado->puesto }}</p>
            <p><strong>Área/Sección:</strong> {{$asignacion->empleado->area }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Partida</th>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $asignacion->equipo->tipo }}</td>
                    <td>1</td>
                    <td>
                        Marca: {{ $asignacion->equipo->marca }}<br>
                        Modelo: {{ $asignacion->equipo->modelo }}<br>
                        Número de serie: {{ $asignacion->equipo->numero_serie }}<br>
                        Etiqueta Skytex: {{ $asignacion->equipo->etiqueta_skytex }}
                    </td>
                </tr>
                <!-- Añadir más filas si es necesario -->
            </tbody>
        </table>
        <div class="footer">
            <p>La(s) persona(s) que firman este documento declaran haber recibido los equipos y herramientas
                proporcionados por la empresa Skytex Mexico, S.A. de C.V., descritos en la parte de arriba en buenas
                condiciones de funcionamiento, el(los) cual(es) se compromete a cuidarlos y utilizarlos correctamente de
                acuerdo a las actividades que se le han asignado. De la misma manera, la(s) persona(s) que firman este
                documento se hacen responsables de cualquier daño o pérdida del equipo entregado. En caso de daño o
                pérdida el departamento de Infraestructura de TI generará el debido reporte de incidencia que se entrega
                a Recursos Humanos para tomar las medidas o sanciones que apliquen al caso. Es importante precisar que
                el equipo de cómputo es de uso personal (a menos que se indique lo contrario en este formato) por lo
                cual la persona que firma esta hoja debe asegurarse del uso adecuado del mismo, no prestarlo sin
                supervisión, al levantarse del equipo debe bloquearse y mucho menos prestar las credenciales de acceso
                (usuario y contraseña). Cualquier actividad que comprometa la integridad del equipo, información y/o
                seguridad informática de la red de la empresa y será reportada a la Dirección de la empresa y
                departamento de Recursos Humanos quienes valoraran y aplicará las medidas y sanciones correspondientes
                al propietario del equipo.</p>
        </div>
        <div class="signature-section">
            <div>
                <p>Víctor Méndez Hdez<br>Gerente de Infraestructura TI</p>
            </div>
            <div>
                <p>Entrega <br>{{ $asignacion->usuario->name }}</p>
            </div>
            <div>
                <p>{{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }}
                    {{ $asignacion->empleado->apellidoM }}<br>Recibe</p>
            </div>
        </div>
    </div>
</body>

</html>
