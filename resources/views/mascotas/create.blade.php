@extends('layouts.app')

@section('title', 'Registrar Mascota')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">🐾 Registrar Nueva Mascota</h1>
        <div class="page-actions">
            <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <!-- Información Básica -->
                <div class="form-group">
                    <label class="form-label">Nombre de la Mascota *</label>
                    <input type="text" name="nombre_mascota" class="form-control" 
                           value="{{ old('nombre_mascota') }}" required>
                    @error('nombre_mascota')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Edad (años) *</label>
                    <input type="number" name="edad" class="form-control" 
                           value="{{ old('edad') }}" min="0" max="30" required>
                    @error('edad')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Género *</label>
                    <select name="genero" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="Macho" {{ old('genero') == 'Macho' ? 'selected' : '' }}>Macho</option>
                        <option value="Hembra" {{ old('genero') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                    </select>
                    @error('genero')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Raza *</label>
                    <input type="text" name="nombre_raza" class="form-control" 
                           value="{{ old('nombre_raza') }}" required>
                    @error('nombre_raza')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado de Salud -->
                <div class="form-group">
                    <label class="form-label">Estado de Salud *</label>
                    <select name="estado_id" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id_estado }}" 
                                    {{ old('estado_id') == $estado->id_estado ? 'selected' : '' }}>
                                {{ $estado->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Fecha de Ingreso *</label>
                    <input type="date" name="fecha_ingreso" class="form-control" 
                           value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
                    @error('fecha_ingreso')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Características -->
                <div class="form-group">
                    <label class="form-label">Vacunado *</label>
                    <select name="vacunado" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('vacunado') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('vacunado') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('vacunado')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Peligroso *</label>
                    <select name="peligroso" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('peligroso') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('peligroso') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('peligroso')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Esterilizado *</label>
                    <select name="esterilizado" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('esterilizado') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('esterilizado') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('esterilizado')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Destetado *</label>
                    <select name="destetado" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('destetado') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('destetado') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('destetado')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">En Crianza *</label>
                    <select name="crianza" class="form-control" required>
                        <option value="">-- Seleccione --</option>
                        <option value="1" {{ old('crianza') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('crianza') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('crianza')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="form-group">
                    <label class="form-label">Imagen</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                    <small class="text-muted">Formatos permitidos: JPG, PNG. Tamaño máximo: 2MB</small>
                    @error('imagen')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Condiciones Especiales -->
            <div class="form-group">
                <div style="display: flex; align-items: center; gap: 10px; margin: 20px 0;">
                    <input type="checkbox" name="condiciones_especiales" id="chkCondiciones" value="1" 
                           {{ old('condiciones_especiales') ? 'checked' : '' }}>
                    <label for="chkCondiciones" class="form-label" style="margin: 0;">
                        ¿Tiene condiciones especiales?
                    </label>
                </div>

                <div id="divDescripcion" style="display: {{ old('condiciones_especiales') ? 'block' : 'none' }};">
                    <label class="form-label">Descripción de la condición especial</label>
                    <textarea name="descripcion_condicion" class="form-control" rows="3" 
                              placeholder="Describe las condiciones especiales de la mascota...">{{ old('descripcion_condicion') }}</textarea>
                    @error('descripcion_condicion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 30px;">
                <button type="submit" class="btn btn-success btn-lg">
                    💾 Guardar Mascota
                </button>
                <a href="{{ route('mascotas.index') }}" class="btn btn-secondary btn-lg">
                    ❌ Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('chkCondiciones').addEventListener('change', function () {
    const divDescripcion = document.getElementById('divDescripcion');
    divDescripcion.style.display = this.checked ? 'block' : 'none';
    
    if (!this.checked) {
        divDescripcion.querySelector('textarea').value = '';
    }
});
</script>
@endsection
