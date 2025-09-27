@extends('layouts.app')

@section('content')
<h1>Editar Adopción</h1>

<form action="{{ route('adopciones.update', ['adopcion' => $adopcion->id_adopcion]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Mascota:</label>
    <select name="id_mascota" required>
        @foreach($mascotas as $m)
            <option value="{{ $m->id_mascota }}" {{ $adopcion->id_mascota == $m->id_mascota ? 'selected' : '' }}>
                {{ $m->nombre_mascota }}
            </option>
        @endforeach
    </select>

    <label>Adoptante:</label>
    <select name="id_adoptante" required>
        @foreach($adoptantes as $a)
            <option value="{{ $a->id_adoptante }}" {{ $adopcion->id_adoptante == $a->id_adoptante ? 'selected' : '' }}>
                {{ $a->nombres }}
            </option>
        @endforeach
    </select>

    <label>Fecha de adopción:</label>
    <input type="date" name="fecha_adopcion" value="{{ $adopcion->fecha_adopcion }}" required>

    <label>Observaciones:</label>
    <textarea name="observaciones" required>{{ old('observaciones', $adopcion->observaciones ?? '') }}</textarea>

    <br><br>
    <button type="submit" class="btn-guardar">Actualizar</button>
</form>
@endsection
