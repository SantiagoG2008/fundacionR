@extends('layouts.app')

@section('content')
<h1>Registrar Adopción</h1>

<form action="{{ route('adopciones.store') }}" method="POST">
    @csrf

    <label>Mascota:</label>
    <select name="id_mascota" required>
        <option value="">-- Seleccione una mascota --</option>
        @foreach($mascotas as $m)
            <option value="{{ $m->id_mascota }}">{{ $m->nombre_mascota }}</option>
        @endforeach
    </select>

    <label>Adoptante:</label>
    <select name="id_adoptante" required>
        <option value="">-- Seleccione un adoptante --</option>
        @foreach($adoptantes as $a)
            <option value="{{ $a->id_adoptante }}">
                {{ $a->nombres }}
            </option>
        @endforeach
    </select>

    <label>Fecha de adopción:</label>
    <input type="date" name="fecha_adopcion" required>

    <label>Observaciones:</label>
    <textarea name="observaciones" required>{{ old('observaciones') }}</textarea>

    <br><br>
    <button type="submit" class="btn-guardar">Guardar</button>
</form>
@endsection
