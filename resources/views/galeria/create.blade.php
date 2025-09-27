@extends('layouts.app')

@section('content')
<h1>Registrar Imagen en la Galería</h1>

<form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Mascota:</label>
    <select name="id_mascota" required>
        <option value="">-- Seleccione una mascota --</option>
        @foreach($mascotas as $m)
            <option value="{{ $m->id_mascota }}">{{ $m->nombre_mascota }}</option>
        @endforeach
    </select>

    <label>Nombre de la imagen:</label>
    <input type="text" name="nombre" required>

    <label>Ruta (archivo):</label>
    <input type="file" name="ruta" accept="image/*" required>

    <br><br>
    <button type="submit" class="btn-guardar">Guardar Imagen</button>
</form>
@endsection
