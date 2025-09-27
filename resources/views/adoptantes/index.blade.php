@extends('layouts.app')

@section('title', 'Adoptantes')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">👤 Gestión de Adoptantes</h1>
        <div class="page-actions">
            <a href="{{ route('adoptantes.create') }}" class="btn btn-primary">
                ➕ Registrar Adoptante
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
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Edad</th>
                        <th>Documento</th>
                        <th>Tipo Doc.</th>
                        <th>Correo</th>
                        <th>Sexo</th>
                        <th>Localidad</th>
                        <th>Barrio</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($adoptantes as $adoptante)
                        <tr>
                            <td><strong>{{ $adoptante->nombres }}</strong></td>
                            <td>{{ $adoptante->telefono }}</td>
                            <td>{{ Str::limit($adoptante->direccion, 30) }}</td>
                            <td>{{ $adoptante->edad }} años</td>
                            <td>{{ $adoptante->nro_docum }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $adoptante->tipoDocumento->nombre_tipo ?? '-' }}
                                </span>
                            </td>
                            <td>{{ Str::limit($adoptante->correo, 20) }}</td>
                            <td>
                                <span class="badge {{ $adoptante->sexo == 'Masculino' ? 'badge-info' : 'badge-warning' }}">
                                    {{ $adoptante->sexo }}
                                </span>
                            </td>
                            <td>{{ $adoptante->localidad->nombre_localidad ?? '-' }}</td>
                            <td>{{ $adoptante->barrio->nombre_barrio ?? $adoptante->barrio_viv }}</td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $adoptante->rol }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('adoptantes.edit', $adoptante) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('adoptantes.destroy', $adoptante) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar este adoptante?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted">
                                <div style="padding: 40px;">
                                    <h4>No hay adoptantes registrados</h4>
                                    <p>Comienza registrando tu primer adoptante</p>
                                    <a href="{{ route('adoptantes.create') }}" class="btn btn-primary">
                                        ➕ Registrar Primer Adoptante
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($adoptantes->hasPages())
        <div class="pagination">
            {{ $adoptantes->links() }}
        </div>
    @endif
</div>
@endsection
