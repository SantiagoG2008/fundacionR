@extends('layouts.app')

@section('title', 'Ver Mensaje')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Mensaje de Contacto</h2>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $contacto->asunto }}</h5>
                    <small class="text-muted">
                        De: {{ $contacto->nombre }} ({{ $contacto->email }})<br>
                        Fecha: {{ $contacto->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $contacto->mensaje }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('contactos.index') }}" class="btn btn-secondary">Volver</a>
                    <form action="{{ route('contactos.destroy', $contacto) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
