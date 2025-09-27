<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Mascotas</title>
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
    <h2>Informe de Mascotas</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Género</th>
                <th>Vacunado</th>
                <th>Peligroso</th>
                <th>Esterilizado</th>
                <th>Destetado</th>
                <th>Crianza</th>
                <th>Condiciones Especiales</th>
                <th>Condición</th>
                <th>Estado</th>
                <th>Raza</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mascotas as $mascota)
                <tr>
                    <td>{{ $mascota->nombre_mascota }}</td>
                    <td>{{ $mascota->edad }}</td>
                    <td>{{ $mascota->genero }}</td>
                    <td>{{ $mascota->vacunado ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->peligroso ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->esterilizado ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->destetado ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->crianza ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->condiciones_especiales ? 'Sí' : 'No' }}</td>
                    <td>{{ $mascota->condicion->descripcion ?? '—' }}</td>
                    <td>{{ $mascota->estado->descripcion ?? '—' }}</td>
                    <td>{{ $mascota->raza->nombre_raza ?? '—' }}</td>
                    <td>{{ $mascota->fecha_ingreso }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
