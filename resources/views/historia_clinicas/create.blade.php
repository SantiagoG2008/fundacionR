@extends('layouts.app')

@section('content')
    <h1>Agregar Historia Clínica</h1>

    <form action="{{ route('historia_clinicas.store') }}" method="POST">
        @csrf

        <label for="id_mascota">Mascota:</label>
        <select name="id_mascota" required>
            @foreach ($mascotas as $mascota)
                <option value="{{ $mascota->id_mascota }}">{{ $mascota->nombre_mascota }}</option>
            @endforeach
        </select>

        <label for="fecha_chequeo">Fecha de Chequeo:</label>
        <input type="date" name="fecha_chequeo" required>

        <label for="peso">Peso (kg):</label>
        <input type="number" step="0.01" name="peso" required>

        <label for="tratamiento">Tratamiento:</label>
        <textarea name="tratamiento" required></textarea>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones"></textarea>

        <label for="cuidados">Cuidados:</label>
        <textarea name="cuidados"></textarea>

        <button type="submit" class="btn-guardar">Guardar</button>
    </form>
@endsection
