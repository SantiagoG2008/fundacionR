@extends('layouts.app')

@section('title', 'Auditoría - Fundación Rescata Amor')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">📋 Auditoría del Sistema</h1>
        <div class="page-actions">
            <span class="text-muted">Registro de todas las operaciones realizadas</span>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card" style="margin-bottom: 2rem; padding: 1.5rem;">
        <form method="GET" action="{{ route('auditoria.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: end;">
            <div class="form-group">
                <label class="form-label">Módulo</label>
                <select name="modulo" class="form-control">
                    <option value="">-- Todos los módulos --</option>
                    @foreach($modulos as $modulo)
                        <option value="{{ $modulo }}" {{ request('modulo') == $modulo ? 'selected' : '' }}>
                            {{ $modulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Fecha Desde</label>
                <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Fecha Hasta</label>
                <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%;">🔍 Filtrar</button>
            </div>

            @if(request()->hasAny(['modulo', 'fecha_desde', 'fecha_hasta']))
            <div class="form-group">
                <a href="{{ route('auditoria.index') }}" class="btn btn-secondary" style="width: 100%;">🔄 Limpiar</a>
            </div>
            @endif
        </form>
    </div>

    <!-- Tabla de Auditoría -->
    <div class="table-container">
        <div class="tabla-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Módulo</th>
                        <th>Tabla</th>
                        <th>ID Registro</th>
                        <th>Acción</th>
                        <th>Usuario</th>
                        <th>Fecha/Hora</th>
                        <th>Antes</th>
                        <th>Después</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($auditorias as $auditoria)
                        <tr>
                            <td>
                                <span class="badge badge-info">#{{ $auditoria->id_auditoria }}</span>
                            </td>
                            <td>
                                <strong>{{ $auditoria->modulo }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $auditoria->tabla }}</small>
                            </td>
                            <td>
                                @if($auditoria->registro_id)
                                    <span class="badge badge-secondary">#{{ $auditoria->registro_id }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($auditoria->accion === 'created')
                                    <span class="badge badge-success">Creado</span>
                                @elseif($auditoria->accion === 'updated')
                                    <span class="badge badge-warning">Modificado</span>
                                @elseif($auditoria->accion === 'deleted')
                                    <span class="badge badge-danger">Eliminado</span>
                                @else
                                    <span class="badge badge-info">{{ ucfirst($auditoria->accion) }}</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $auditoria->usuario }}</strong>
                                @if($auditoria->ip)
                                    <br><small class="text-muted">{{ $auditoria->ip }}</small>
                                @endif
                            </td>
                            <td>
                                {{ $auditoria->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td style="max-width: 200px;">
                                @if($auditoria->valores_anteriores)
                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                            onclick="mostrarValores('anteriores-{{ $auditoria->id_auditoria }}')">
                                        Ver
                                    </button>
                                    <div id="anteriores-{{ $auditoria->id_auditoria }}" style="display: none; margin-top: 10px;">
                                        <pre style="background: #f8f9fa; padding: 10px; border-radius: 4px; font-size: 11px; max-height: 200px; overflow-y: auto;">{{ $auditoria->valores_anteriores }}</pre>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td style="max-width: 200px;">
                                @if($auditoria->valores_nuevos)
                                    <button type="button" class="btn btn-sm btn-outline-success" 
                                            onclick="mostrarValores('nuevos-{{ $auditoria->id_auditoria }}')">
                                        Ver
                                    </button>
                                    <div id="nuevos-{{ $auditoria->id_auditoria }}" style="display: none; margin-top: 10px;">
                                        <pre style="background: #f8f9fa; padding: 10px; border-radius: 4px; font-size: 11px; max-height: 200px; overflow-y: auto;">{{ $auditoria->valores_nuevos }}</pre>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted" style="padding: 40px;">
                                <h4>No hay registros de auditoría</h4>
                                <p>Los registros aparecerán aquí cuando se realicen operaciones en el sistema.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($auditorias->hasPages())
        <div class="pagination">
            {{ $auditorias->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<script>
function mostrarValores(id) {
    const elemento = document.getElementById(id);
    if (elemento.style.display === 'none' || elemento.style.display === '') {
        elemento.style.display = 'block';
    } else {
        elemento.style.display = 'none';
    }
}
</script>
@endsection

