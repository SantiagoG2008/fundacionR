<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Historias Clínicas</title>
    
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
    <h1>Informe de Historias Clínicas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
            <th>Mascota</th>
            <th>Fecha Chequeo</th>
            <th>Peso (kg)</th>
            <th>Tratamiento</th>
            <th>Observaciones</th>
            <th>Cuidados</th>
            </tr>y
        </thead>
        <tbody>
            @foreach($historias as $h)
                <tr>
                    <td>{{ $h->id_historia }}</td>
                <td>{{ $h->mascota->nombre_mascota ?? 'Sin nombre' }}</td>
                <td>{{ $h->fecha_chequeo }}</td>
                <td>{{ $h->peso }}</td>
                <td>{{ $h->tratamiento }}</td>
                <td>{{ $h->observaciones ?? '-' }}</td>
                <td>{{ $h->cuidados ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
