<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Adoptantes</title>
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
    <h2>Informe de Adoptantes</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Tipo</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Sexo</th>
                <th>Dirección</th>
                <th>Localidad</th>
                <th>Barrio</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adoptantes as $adoptante)
                <tr>
                    <td>{{ $adoptante->nombres }} {{ $adoptante->apellidos }}</td>
                    <td>{{ $adoptante->nro_docum }}</td>
                    <td>{{ $adoptante->tipoDocumento->nombre_tipo ?? '—' }}</td>
                    <td>{{ $adoptante->edad }}</td>
                    <td>{{ $adoptante->telefono }}</td>
                    <td>{{ $adoptante->correo }}</td>
                    <td>{{ $adoptante->sexo }}</td>
                    <td>{{ $adoptante->direccion }}</td>
                    <td>{{ $adoptante->localidad->nombre_localidad ?? '—' }}</td>
                    <td>{{ $adoptante->barrio->nombre_barrio ?? '—' }}</td>
                    <td>{{ ucfirst($adoptante->rol) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
