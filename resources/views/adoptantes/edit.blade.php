@extends('layouts.app')

@section('content')
<h1>Editar Adoptante</h1>

<form action="{{ route('adoptantes.update', $adoptante) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="nombres" value="{{ old('nombres', $adoptante->nombres) }}" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="{{ old('telefono', $adoptante->telefono) }}">

    <label>Dirección:</label>
    <input type="text" name="direccion" value="{{ old('direccion', $adoptante->direccion) }}">

    <label>Edad:</label>
    <input type="number" name="edad" value="{{ old('edad', $adoptante->edad) }}">

    <label for="nro_docum">Número de documento:</label>
<input type="number" name="nro_docum" value="{{ old('nro_docum', $adoptante->nro_docum) }}" required>

@error('nro_docum')
<div class="alert-danger">⚠️ {{ $message }}</div>
@enderror

    <label>Tipo Documento:</label>
    <select name="id_tipo" required>
    <option value="">Seleccione...</option>
    @foreach($tipos as $tipo)
        <option value="{{ $tipo->id_tipo }}" 
            {{ old('id_tipo', $adoptante->id_tipo) == $tipo->id_tipo ? 'selected' : '' }}>
            {{ $tipo->nombre_tipo }}
        </option>
    @endforeach
</select>

    <div class="form-group">
    <label>Correo:</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo', $adoptante->correo) }}">
</div>

    <label>Sexo:</label>
    <select name="sexo" required>
        <option value="M" {{ old('sexo', $adoptante->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
        <option value="F" {{ old('sexo', $adoptante->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
        <option value="O" {{ old('sexo', $adoptante->sexo) == 'O' ? 'selected' : '' }}>Otro</option>
    </select>

    <label>Localidad:</label>
    <select name="id_localidad" required>
        <option value="">Seleccione...</option>
        @foreach($localidades as $loc)
            <option value="{{ $loc->id_localidad }}" 
                {{ old('id_localidad', $adoptante->id_localidad) == $loc->id_localidad ? 'selected' : '' }}>
                {{ $loc->nombre_localidad }}
            </option>
        @endforeach
    </select>

    <label>Barrio:</label>
        <input type="text" name="barrio_viv" value="{{ old('barrio_viv', $adoptante->barrio->nombre_barrio ?? '') }}" required>

    <label>Rol:</label>
    <select name="rol" required>
        <option value="adoptante" {{ old('rol', $adoptante->rol) == 'adoptante' ? 'selected' : '' }}>Adoptante</option>
        <option value="donante" {{ old('rol', $adoptante->rol) == 'donante' ? 'selected' : '' }}>Donante</option>
        <option value="ambos" {{ old('rol', $adoptante->rol) == 'ambos' ? 'selected' : '' }}>Ambos</option>
    </select>

    <br><br>
    <button type="submit" class="btn-guardar">Actualizar</button>
</form>
@endsection