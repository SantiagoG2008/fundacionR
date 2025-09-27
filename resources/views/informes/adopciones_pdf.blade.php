<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Adopciones</title>
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
    <h2>Informe de Adopciones</h2>

    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Adoptante</th>
                <th>Fecha de Adopción</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopciones as $adopcion)
                <tr>
                    <td>{{ $adopcion->mascota->nombre_mascota ?? '—' }}</td>
                    <td>{{ $adopcion->adoptante->nombres ?? '—' }}</td>
                    <td>{{ $adopcion->fecha_adopcion }}</td>
                    <td>{{ $adopcion->observaciones ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
