@extends('layouts.app')

@section('content')
<h1>Editar Mascota</h1>

<form action="{{ route('mascotas.update', $mascota) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="nombre_mascota" value="{{ $mascota->nombre_mascota }}" required>

    <label>Edad:</label>
    <input type="number" name="edad" value="{{ $mascota->edad }}" required>

    <label>Género:</label>
    <select name="genero" required>
        <option value="Macho" {{ $mascota->genero == 'Macho' ? 'selected' : '' }}>Macho</option>
        <option value="Hembra" {{ $mascota->genero == 'Hembra' ? 'selected' : '' }}>Hembra</option>
    </select>

    <label>Vacunado:</label>
    <select name="vacunado" required>
        <option value="1" {{ $mascota->vacunado ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$mascota->vacunado ? 'selected' : '' }}>No</option>
    </select>

    <label>Peligroso:</label>
    <select name="peligroso" required>
        <option value="1" {{ $mascota->peligroso ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$mascota->peligroso ? 'selected' : '' }}>No</option>
    </select>

    <label>Esterilizado:</label>
    <select name="esterilizado" required>
        <option value="1" {{ $mascota->esterilizado ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$mascota->esterilizado ? 'selected' : '' }}>No</option>
    </select>

    <label>Destetado:</label>
    <select name="destetado" required>
        <option value="1" {{ $mascota->destetado ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$mascota->destetado ? 'selected' : '' }}>No</option>
    </select>

    <label>Raza:</label>
    <input type="text" name="nombre_raza" value="{{ old('nombre_raza', $mascota->raza->nombre_raza ?? '') }}" required>


    <label>Estado:</label>
    <select name="estado_id" required>
        @foreach($estados as $e)
            <option value="{{ $e->id_estado }}" {{ $mascota->estado_id == $e->id_estado ? 'selected' : '' }}>{{ $e->descripcion }}</option>
        @endforeach
    </select>

    <label>Fecha de ingreso:</label>
    <input type="date" name="fecha_ingreso" value="{{ $mascota->fecha_ingreso }}" required>

    <label>Crianza:</label>
    <select name="crianza" required>
        <option value="1" {{ $mascota->crianza ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ !$mascota->crianza ? 'selected' : '' }}>No</option>
    </select>

    <label>Imagen actual:</label>
    @if($mascota->imagen)
        <div><img src="{{ asset('storage/' . $mascota->imagen) }}" width="120"></div>
    @endif
    <input type="file" name="imagen">

    <label>
        <input type="checkbox" name="condiciones_especiales" id="chkCondiciones" value="1" {{ $mascota->condicion ? 'checked' : '' }}>
        ¿Tiene condición especial?
    </label>

    <div id="divDescripcion">
        <label>Descripción de la condición:</label>
        <textarea name="descripcion_condicion">{{ $mascota->condicion->descripcion ?? '' }}</textarea>
    </div>

    <br><br>
    <button type="submit" class="btn-guardar">Actualizar</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chk = document.getElementById('chkCondiciones');
        const div = document.getElementById('divDescripcion');
        const textarea = document.querySelector('textarea[name="descripcion_condicion"]');

        function toggleDescripcion() {
            div.style.display = chk.checked ? 'block' : 'none';
            if (!chk.checked) textarea.value = '';
        }

        chk.addEventListener('change', toggleDescripcion);
        toggleDescripcion();
    });
</script>
@endsection
