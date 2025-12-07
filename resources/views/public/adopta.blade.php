@extends('public.layout')

@section('title', 'Adopta - Fundación Rescata Amor')

@section('content')
@if(request('seccion') !== 'mis-solicitudes' && !request()->filled('identificador'))
<section class="content-section">
    <h1 class="section-title">Peluditos listos para adoptarse</h1>
    <p class="section-subtitle">El listado se sincroniza con el panel administrativo para que siempre veas la disponibilidad real.</p>
    <div class="card-grid">
        @forelse($mascotas as $mascota)
            <article class="card profile-card">
                <img src="{{ $mascota->imagen_url ?? asset('img/perro-animado.gif') }}" alt="Mascota {{ $mascota->nombre_mascota }}">
                <div>
                    <h3>{{ $mascota->nombre_mascota }} · {{ $mascota->edad }} años</h3>
                    <p>{{ $mascota->raza->nombre_raza ?? 'Sin raza' }} · {{ $mascota->estado->descripcion ?? 'Sin estado' }}</p>
                    <ul class="list-check">
                        <li>{{ $mascota->genero === 'M' ? 'Macho' : ($mascota->genero === 'F' ? 'Hembra' : $mascota->genero) }}</li>
                        <li>{{ $mascota->vacunado ? 'Vacunado' : 'Sin vacunas al día' }}</li>
                        <li>{{ $mascota->esterilizado ? 'Esterilizado' : 'Sin esterilizar' }}</li>
                    </ul>
                    <a href="{{ route('contacto', ['mascota' => $mascota->id_mascota]) }}" class="btn btn-primary" style="margin-top:0.75rem; display:inline-block;">
                        Solicitar adopción
                    </a>
                </div>
            </article>
        @empty
            <p class="state-message">En este momento no hay mascotas publicadas.</p>
        @endforelse
    </div>
    <div class="state-message" style="background: transparent; color: inherit;">
        {{ $mascotas->links() }}
    </div>
</section>
@endif

@if(request('seccion') !== 'mis-solicitudes' && !request()->filled('identificador'))
<section class="content-section soft">
    <h2 class="section-title">Pasos para adoptar</h2>
    <div class="card-grid">
        <article class="card">
            <h3>1. Conoce y elige</h3>
            <p>Revisa la información del peludo que te enamoró y agenda una visita para que se conozcan.</p>
        </article>
        <article class="card">
            <h3>2. Postula</h3>
            <p>Completa el formulario de adopción y cuéntanos sobre tu estilo de vida y hogar.</p>
        </article>
        <article class="card">
            <h3>3. Recibe acompañamiento</h3>
            <p>Te orientamos con recomendaciones de cuidado y seguimiento post adopción.</p>
        </article>
    </div>
</section>
@endif

<section id="mis-solicitudes" class="content-section">
    <h2 class="section-title">Mis solicitudes de adopción</h2>
    <p class="section-subtitle">
        Ingresa el correo o número de documento que usaste al registrarte como adoptante para ver el estado de tus solicitudes.
    </p>

    <form method="GET" class="card form-card" style="margin-bottom: 2rem;">
        @error('identificador')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <div class="form-row">
            <label for="identificador">Correo o número de documento</label>
            <input
                id="identificador"
                type="text"
                name="identificador"
                value="{{ request('identificador') }}"
                placeholder="Ej: tunombre@correo.com o 123456789"
            >
        </div>
        <button type="submit" class="btn btn-primary">Buscar mis solicitudes</button>
    </form>

    @isset($adopciones)
        @if($adopciones && $adopciones->isEmpty())
            <p class="state-message">No encontramos solicitudes asociadas a ese dato.</p>
        @elseif($adopciones)
            <div class="list-module">
                @foreach($adopciones as $adopcion)
                    <article class="card profile-card">
                        <div class="detail-media">
                            @if($adopcion->mascota && $adopcion->mascota->imagen_url)
                                <img src="{{ $adopcion->mascota->imagen_url }}" alt="Mascota {{ $adopcion->mascota->nombre_mascota }}">
                            @else
                                <img src="{{ asset('img/perro-animado.gif') }}" alt="Mascota">
                            @endif
                        </div>
                        <div>
                            <h3>{{ $adopcion->mascota->nombre_mascota ?? 'Mascota' }}</h3>
                            <p class="text-muted">
                                Fecha de solicitud/adopción:
                                {{ $adopcion->fecha_adopcion ? \Carbon\Carbon::parse($adopcion->fecha_adopcion)->format('d/m/Y') : 'Pendiente de asignar' }}
                            </p>
                            @php
                                $estado = $adopcion->fecha_adopcion ? 'Aprobada' : 'Pendiente';
                            @endphp
                            <p><strong>Estado:</strong> {{ $estado }}</p>
                            @if($adopcion->observaciones)
                                <p><strong>Observaciones:</strong> {{ $adopcion->observaciones }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    @endisset
</section>
@endsection
