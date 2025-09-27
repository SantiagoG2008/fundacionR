@extends('layouts.app')

@section('content')
<h1>Editar Historia Clínica</h1>

<form action="{{ route('historia_clinicas.update', $historiaClinica) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Mascota:</label>
    <select name="id_mascota" required>
        @foreach ($mascotas as $m)
            <option value="{{ $m->id_mascota }}" {{ $historiaClinica->id_mascota == $m->id_mascota ? 'selected' : '' }}>
                {{ $m->nombre_mascota }}
            </option>
        @endforeach
    </select>

    <label>Fecha de Chequeo:</label>
    <input type="date" name="fecha_chequeo" value="{{ $historiaClinica->fecha_chequeo }}" required>

    <label>Peso (kg):</label>
    <input type="number" step="0.01" name="peso" value="{{ $historiaClinica->peso }}" required>

    <label>Tratamiento:</label>
    <textarea name="tratamiento" required>{{ $historiaClinica->tratamiento }}</textarea>

    <label>Observaciones:</label>
    <textarea name="observaciones">{{ $historiaClinica->observaciones }}</textarea>

    <label>Cuidados:</label>
    <textarea name="cuidados">{{ $historiaClinica->cuidados }}</textarea>

    <br><br>
    <button type="submit" class="btn-guardar">Actualizar</button>
</form>
@endsection
