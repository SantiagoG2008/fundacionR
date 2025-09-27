@extends('layouts.app')

@section('title', 'Mascotas')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">🐾 Gestión de Mascotas</h1>
        <div class="page-actions">
            <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
                ➕ Registrar Mascota
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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Género</th>
                        <th>Vacunado</th>
                        <th>Peligroso</th>
                        <th>Esterilizado</th>
                        <th>Destetado</th>
                        <th>Crianza</th>
                        <th>Condiciones</th>
                        <th>Estado</th>
                        <th>Raza</th>
                        <th>Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mascotas as $mascota)
                        <tr>
                            <td>
                                @if($mascota->imagen)
                                    <img src="{{ $mascota->imagen_url }}" 
                                         alt="Imagen" 
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 60px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px;">
                                        Sin imagen
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $mascota->nombre_mascota }}</strong></td>
                            <td>{{ $mascota->edad }} años</td>
                            <td>
                                <span class="badge {{ $mascota->genero == 'Macho' ? 'badge-info' : 'badge-warning' }}">
                                    {{ $mascota->genero }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mascota->vacunado ? 'badge-success' : 'badge-danger' }}">
                                    {{ $mascota->vacunado ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mascota->peligroso ? 'badge-danger' : 'badge-success' }}">
                                    {{ $mascota->peligroso ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mascota->esterilizado ? 'badge-success' : 'badge-warning' }}">
                                    {{ $mascota->esterilizado ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mascota->destetado ? 'badge-success' : 'badge-warning' }}">
                                    {{ $mascota->destetado ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $mascota->crianza ? 'badge-info' : 'badge-secondary' }}">
                                    {{ $mascota->crianza ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td>
                                @if($mascota->condiciones_especiales)
                                    <span class="badge badge-warning">Especial</span>
                                @else
                                    <span class="badge badge-success">Normal</span>
                                @endif
                            </td>
                            <td>{{ $mascota->estado->descripcion ?? '-' }}</td>
                            <td>{{ $mascota->raza->nombre_raza ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($mascota->fecha_ingreso)->format('d/m/Y') }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('mascotas.edit', $mascota) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('mascotas.destroy', $mascota) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center text-muted">
                                <div style="padding: 40px;">
                                    <h4>No hay mascotas registradas</h4>
                                    <p>Comienza registrando tu primera mascota</p>
                                    <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
                                        ➕ Registrar Primera Mascota
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($mascotas->hasPages())
        <div class="pagination">
            {{ $mascotas->links() }}
        </div>
    @endif
</div>
@endsection