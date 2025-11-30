@extends('public.layout')

@section('title', 'Adopta - Fundación Rescata Amor')

@section('content')
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

<section id="mi-mascota" class="content-section soft">
    <h2 class="section-title">Mi mascota adoptada</h2>
    <p class="section-subtitle">
        Si ya adoptaste, con el mismo dato anterior puedes ver la ficha y la historia clínica básica de tu mascota.
    </p>

    @if(isset($lookupAttempted) && $lookupAttempted)
        @if(!$miMascota)
            <p class="state-message">No encontramos una mascota asociada a ese dato. Verifica la información o consulta con la fundación.</p>
        @else
            <div class="detail-layout">
                <div class="detail-media">
                    <img src="{{ $miMascota->imagen_url ?? asset('img/perro-animado.gif') }}" alt="Mascota {{ $miMascota->nombre_mascota }}">
                </div>
                <div class="detail-info">
                    <h3 class="section-title">{{ $miMascota->nombre_mascota }}</h3>
                    <p class="text-muted">
                        {{ $miMascota->raza->nombre_raza ?? 'Sin raza registrada' }} ·
                        {{ $miMascota->edad }} años ·
                        {{ $miMascota->genero === 'M' ? 'Macho' : ($miMascota->genero === 'F' ? 'Hembra' : $miMascota->genero) }}
                    </p>
                    <ul class="list-check" style="margin-top: 1rem;">
                        <li>{{ $miMascota->vacunado ? 'Vacunado' : 'Sin vacunas al día' }}</li>
                        <li>{{ $miMascota->esterilizado ? 'Esterilizado' : 'Sin esterilizar' }}</li>
                        <li>{{ $miMascota->destetado ? 'Destetado' : 'Aún en proceso de destete' }}</li>
                        <li>{{ $miMascota->peligroso ? 'Requiere manejo especial' : 'No catalogado como peligroso' }}</li>
                    </ul>
                </div>
            </div>

            @if(isset($historias) && $historias->isNotEmpty())
                <div class="content-section">
                    <h3 class="section-title">Historia clínica</h3>
                    <div class="list-module">
                        @foreach($historias as $historia)
                            <article>
                                <h4>{{ \Carbon\Carbon::parse($historia->fecha_chequeo)->format('d/m/Y') }}</h4>
                                <p><strong>Peso:</strong> {{ $historia->peso }} kg</p>
                                @if($historia->tratamiento)
                                    <p><strong>Tratamiento:</strong> {{ $historia->tratamiento }}</p>
                                @endif
                                @if($historia->observaciones)
                                    <p><strong>Observaciones:</strong> {{ $historia->observaciones }}</p>
                                @endif
                                @if($historia->cuidados)
                                    <p><strong>Cuidados recomendados:</strong> {{ $historia->cuidados }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="state-message">Aún no hay historia clínica registrada para esta mascota.</p>
            @endif
        @endif
    @endif
</section>
@endsection
