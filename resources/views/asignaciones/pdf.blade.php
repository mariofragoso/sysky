<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Equipo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .content {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        small {
            font-size: 0.7em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Formato de Entrega de Equipo</h2>
        </div>
        <div class="content">
            <p><strong>Recibe:</strong> {{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellidoP }}
                {{ $asignacion->empleado->apellidoM }} <strong>Fecha:</strong> {{ $asignacion->fecha_asignacion }}</p>
            <p><strong>Nómina:</strong> {{ $asignacion->empleado->numero_nomina }}</p>
            <p><strong>Departamento:</strong> {{ $asignacion->empleado->area }} <strong>Cargo:</strong>
                {{ $asignacion->empleado->puesto }}</p>
            <p><strong>Área/Sección:</strong> {{ $asignacion->empleado->area }}</p>
            <p><strong>Recibe el siguiente equipo:</strong></p>
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
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p style="text-align: justify;"><small>La(s) persona(s) que firman este documento declaran haber recibido los
                    equipos y herramientas
                    proporcionados por la empresa Skytex Mexico, S.A. de C.V., descritos en la parte de arriba en buenas
                    condiciones de funcionamiento, el(los) cual(es) se compromete a cuidarlos y utilizarlos
                    correctamente de
                    acuerdo a las actividades que se le han asignado. De la misma manera, la(s) persona(s) que firman
                    este
                    documento se hacen responsables de cualquier daño o pérdida del equipo entregado. En caso de daño o
                    pérdida el departamento de Infraestructura de TI generará el debido reporte de incidencia que se
                    entrega
                    a Recursos Humanos para tomar las medidas o sanciones que apliquen al caso. Es importante precisar
                    que
                    el equipo de cómputo es de uso personal (a menos que se indique lo contrario en este formato) por lo
                    cual la persona que firma esta hoja debe asegurarse del uso adecuado del mismo, no prestarlo sin
                    supervisión, al levantarse del equipo debe bloquearse y mucho menos prestar las credenciales de
                    acceso
                    (usuario y contraseña). Cualquier actividad que comprometa la integridad del equipo, información y/o
                    seguridad informática de la red de la empresa y será reportada a la Dirección de la empresa y
                    departamento de Recursos Humanos quienes valoraran y aplicará las medidas y sanciones
                    correspondientes
                    al propietario del equipo.</small></p>
            <p>Entrega: _____________________ Recibe: _____________________</p>
        </div>
    </div>
</body>

</html>
