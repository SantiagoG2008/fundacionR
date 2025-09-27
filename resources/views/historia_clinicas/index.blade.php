@extends('layouts.app')

@section('title', 'Historias Clínicas')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">🩺 Gestión de Historias Clínicas</h1>
        <div class="page-actions">
            <a href="{{ route('historia_clinicas.create') }}" class="btn btn-primary">
                ➕ Registrar Historia Clínica
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
                        <th>Fecha Chequeo</th>
                        <th>Peso (kg)</th>
                        <th>Tratamiento</th>
                        <th>Observaciones</th>
                        <th>Cuidados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historias as $historia)
                        <tr>
                            <td>
                                <span class="badge badge-info">#{{ $historia->id_historia }}</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($historia->mascota->imagen ?? false)
                                        <img src="{{ $historia->mascota->imagen_url }}" 
                                             alt="Imagen" 
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    @endif
                                    <div>
                                        <strong>{{ $historia->mascota->nombre_mascota ?? 'Sin nombre' }}</strong>
                                        @if($historia->mascota ?? false)
                                            <br><small class="text-muted">{{ $historia->mascota->raza->nombre_raza ?? '' }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    {{ \Carbon\Carbon::parse($historia->fecha_chequeo)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $historia->peso }} kg</strong>
                            </td>
                            <td>{{ Str::limit($historia->tratamiento, 30) }}</td>
                            <td>{{ Str::limit($historia->observaciones, 30) ?: '-' }}</td>
                            <td>{{ Str::limit($historia->cuidados, 30) ?: '-' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('historia_clinicas.edit', $historia) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('historia_clinicas.destroy', $historia) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta historia clínica?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <div style="padding: 40px;">
                                    <h4>No hay historias clínicas registradas</h4>
                                    <p>Comienza registrando la primera historia clínica</p>
                                    <a href="{{ route('historia_clinicas.create') }}" class="btn btn-primary">
                                        ➕ Registrar Primera Historia Clínica
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($historias->hasPages())
        <div class="pagination">
            {{ $historias->links() }}
        </div>
    @endif
</div>
@endsection
