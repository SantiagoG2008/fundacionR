@extends('layouts.app')

@section('title', 'Adopciones')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">📄 Gestión de Adopciones</h1>
        <div class="page-actions">
            <a href="{{ route('adopciones.create') }}" class="btn btn-primary">
                ➕ Registrar Adopción
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
                        <th>Mascota</th>
                        <th>Adoptante</th>
                        <th>Fecha de Adopción</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($adopciones as $adopcion)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($adopcion->mascota->imagen ?? false)
                                        <img src="{{ $adopcion->mascota->imagen_url }}" 
                                             alt="Imagen" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    @endif
                                    <div>
                                        <strong>{{ $adopcion->mascota->nombre_mascota ?? '-' }}</strong>
                                        @if($adopcion->mascota ?? false)
                                            <br><small class="text-muted">{{ $adopcion->mascota->raza->nombre_raza ?? '' }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $adopcion->adoptante->nombres ?? '-' }}</strong>
                                    @if($adopcion->adoptante ?? false)
                                        <br><small class="text-muted">{{ $adopcion->adoptante->telefono ?? '' }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    {{ \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>{{ Str::limit($adopcion->observaciones, 50) ?: '-' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('adopciones.edit', $adopcion) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('adopciones.destroy', $adopcion) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta adopción?')">
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
                                    <h4>No hay adopciones registradas</h4>
                                    <p>Comienza registrando tu primera adopción</p>
                                    <a href="{{ route('adopciones.create') }}" class="btn btn-primary">
                                        ➕ Registrar Primera Adopción
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($adopciones->hasPages())
        <div class="pagination">
            {{ $adopciones->links() }}
        </div>
    @endif
</div>
@endsection
