@extends('layouts.app')

@section('title', 'Donaciones')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">🤝 Gestión de Donaciones</h1>
        <div class="page-actions">
            <a href="{{ route('donaciones.create') }}" class="btn btn-primary">
                ➕ Nueva Donación
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
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Adoptante</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donaciones as $donacion)
                        @php $det = $donacion->detalles->first(); @endphp
                        <tr>
                            <td>
                                <span class="badge badge-info">#{{ $donacion->id_donacion }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $donacion->tipo == 'Monetaria' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $donacion->tipo }}
                                </span>
                            </td>
                            <td>
                                <strong>
                                    @if($donacion->tipo == 'Monetaria')
                                        ${{ number_format($donacion->cantidad, 0, ',', '.') }}
                                    @else
                                        {{ $donacion->cantidad }} unidades
                                    @endif
                                </strong>
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    {{ \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $donacion->adoptante->nombres ?? 'N/A' }}</strong>
                                    @if($donacion->adoptante ?? false)
                                        <br><small class="text-muted">{{ $donacion->adoptante->telefono ?? '' }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>{{ Str::limit($det->descripcion_producto ?? '-', 40) }}</td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                    <a href="{{ route('donaciones.edit', $donacion->id_donacion) }}" class="btn btn-warning btn-sm">
                                        ✏️ Editar
                                    </a>
                                    <form action="{{ route('donaciones.destroy', $donacion->id_donacion) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta donación?')">
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
                                    <h4>No hay donaciones registradas</h4>
                                    <p>Comienza registrando la primera donación</p>
                                    <a href="{{ route('donaciones.create') }}" class="btn btn-primary">
                                        ➕ Registrar Primera Donación
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($donaciones->hasPages())
        <div class="pagination">
            {{ $donaciones->links() }}
        </div>
    @endif
</div>
@endsection
