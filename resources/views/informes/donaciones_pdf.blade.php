<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Donaciones</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2d4f5;
        }
    </style>
</head>
<body>
    <h2>Informe de Donaciones</h2>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Adoptante</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donaciones as $donacion)
                <tr>
                    <td>{{ $donacion->tipo }}</td>
                    <td>{{ $donacion->cantidad }}</td>
                    <td>{{ $donacion->fecha }}</td>
                    <td>{{ $donacion->adoptante->nombres ?? '—' }}</td>
                    <td>
                            @foreach($donacion->detalles as $detalle)
                                {{ $detalle->descripcion_producto }}<br>
                            @endforeach
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
