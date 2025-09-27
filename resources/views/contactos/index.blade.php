@extends('layouts.app')

@section('title', 'Mensajes de Contacto')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">📧 Mensajes de Contacto</h1>
        <div class="page-actions">
            <span class="text-muted">{{ $contactos->total() }} mensajes</span>
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
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contactos as $contacto)
                        <tr class="{{ $contacto->leido ? '' : 'table-warning' }}">
                            <td>
                                <span class="badge badge-info">#{{ $contacto->id }}</span>
                            </td>
                            <td>
                                <strong>{{ $contacto->nombre }}</strong>
                            </td>
                            <td>{{ Str::limit($contacto->email, 25) }}</td>
                            <td>{{ Str::limit($contacto->asunto, 40) }}</td>
                            <td>
                                <span class="badge badge-success">
                                    {{ $contacto->created_at->format('d/m/Y') }}
                                </span>
                                <br><small class="text-muted">{{ $contacto->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                @if($contacto->leido)
                                    <span class="badge badge-success">✅ Leído</span>
                                @else
                                    <span class="badge badge-warning">🆕 Nuevo</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('contactos.show', $contacto) }}" class="btn btn-primary btn-sm">
                                        👁️ Ver
                                    </a>
                                    <form action="{{ route('contactos.destroy', $contacto) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar este mensaje?')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <div style="padding: 40px;">
                                    <h4>No hay mensajes de contacto</h4>
                                    <p>Los mensajes enviados desde el formulario de contacto aparecerán aquí</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($contactos->hasPages())
        <div class="pagination">
            {{ $contactos->links() }}
        </div>
    @endif
</div>
@endsection
