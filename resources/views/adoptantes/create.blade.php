@extends('layouts.app')

@section('title', 'Registrar Adoptante')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">👤 Registrar Nuevo Adoptante</h1>
        <div class="page-actions">
            <a href="{{ route('adoptantes.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('adoptantes.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <!-- Información Personal -->
                <div class="form-group">
                    <label class="form-label">Nombre Completo *</label>
                    <input type="text" name="nombres" class="form-control" 
                           value="{{ old('nombres') }}" required>
                    @error('nombres')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Teléfono *</label>
                    <input type="tel" name="telefono" class="form-control" 
                           value="{{ old('telefono') }}" required>
                    @error('telefono')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" name="correo" class="form-control" 
                           value="{{ old('correo') }}" required>
                    @error('correo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control" 
                           value="{{ old('edad') }}" min="18" max="100">
                    @error('edad')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Documento -->
                <div class="form-group">
                    <label class="form-label">Número de Documento *</label>
                    <input type="text" name="nro_docum" class="form-control" 
                           value="{{ old('nro_docum') }}" required>
                    @error('nro_docum')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Documento *</label>
                    <select name="id_tipo" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id_tipo }}" 
                                    {{ old('id_tipo') == $tipo->id_tipo ? 'selected' : '' }}>
                                {{ $tipo->nombre_tipo }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_tipo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ubicación -->
                <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" 
                           value="{{ old('direccion') }}">
                    @error('direccion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Localidad *</label>
                    <select name="id_localidad" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($localidades as $localidad)
                            <option value="{{ $localidad->id_localidad }}" 
                                    {{ old('id_localidad') == $localidad->id_localidad ? 'selected' : '' }}>
                                {{ $localidad->nombre_localidad }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_localidad')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Barrio *</label>
                    <input type="text" name="barrio_viv" class="form-control" 
                           value="{{ old('barrio_viv') }}" required>
                    @error('barrio_viv')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Características -->
                <div class="form-group">
                    <label class="form-label">Sexo *</label>
                    <select name="sexo" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Rol *</label>
                    <select name="rol" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="adoptante" {{ old('rol') == 'adoptante' ? 'selected' : '' }}>Adoptante</option>
                        <option value="donante" {{ old('rol') == 'donante' ? 'selected' : '' }}>Donante</option>
                        <option value="ambos" {{ old('rol') == 'ambos' ? 'selected' : '' }}>Adoptante y Donante</option>
                    </select>
                    @error('rol')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Política de Datos -->
            <div class="form-group" style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
                <div style="display: flex; align-items: flex-start; gap: 10px;">
                    <input type="checkbox" name="acepta_politica" id="acepta_politica" value="1" 
                           {{ old('acepta_politica') ? 'checked' : '' }} required
                           style="margin-top: 5px; width: 20px; height: 20px; cursor: pointer;">
                    <label for="acepta_politica" style="cursor: pointer; flex: 1; margin: 0;">
                        <strong>Acepto la política de tratamiento de datos personales *</strong>
                        <br>
                        <small style="color: #6c757d; line-height: 1.5;">
                            Autorizo a la Fundación Rescata Amor para el tratamiento de mis datos personales de acuerdo con la Ley 1581 de 2012 y el Decreto 1377 de 2013. 
                            Mis datos serán utilizados exclusivamente para los fines relacionados con el proceso de adopción, donación y comunicación institucional. 
                            Puedo ejercer mis derechos de conocer, actualizar, rectificar y suprimir mis datos personales en cualquier momento.
                        </small>
                    </label>
                </div>
                @error('acepta_politica')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 30px;">
                <button type="submit" class="btn btn-success btn-lg">
                    💾 Guardar Adoptante
                </button>
                <a href="{{ route('adoptantes.index') }}" class="btn btn-secondary btn-lg">
                    ❌ Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
