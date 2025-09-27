@extends('layouts.app')

@section('title', 'Galería de Imágenes')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">🖼️ Gestión de Galería</h1>
        <div class="page-actions">
            <a href="{{ route('galeria.create') }}" class="btn btn-primary">
                ➕ Registrar Imagen
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="tabla-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mascota</th>
                        <th>Nombre Imagen</th>
                        <th>Vista Previa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($imagenes as $imagen)
                        <tr>
                            <td>
                                <span class="badge badge-info">#{{ $imagen->id_imagen }}</span>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $imagen->mascota->nombre_mascota ?? 'Sin nombre' }}</strong>
                                    @if($imagen->mascota ?? false)
                                        <br><small class="text-muted">{{ $imagen->mascota->raza->nombre_raza ?? '' }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <strong>{{ $imagen->nombre }}</strong>
                            </td>
                            <td>
                                @if($imagen->ruta)
                                    <img src="{{ $imagen->ruta_url }}" 
                                         alt="Vista previa" 
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                @else
                                    <div style="width: 80px; height: 80px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px; border: 2px dashed #dee2e6;">
                                        Sin imagen
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('galeria.edit', $imagen) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('galeria.destroy', $imagen) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <div style="padding: 40px;">
                                    <h4>No hay imágenes en la galería</h4>
                                    <p>Comienza agregando la primera imagen</p>
                                    <a href="{{ route('galeria.create') }}" class="btn btn-primary">
                                        ➕ Agregar Primera Imagen
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($imagenes->hasPages())
        <div class="pagination">
            {{ $imagenes->links() }}
        </div>
    @endif
</div>
@endsection
