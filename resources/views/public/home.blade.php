@extends('public.layout')

@section('title', 'Fundación Rescata Amor')

@section('content')
<section class="hero">
    <div class="hero-text">
        <p class="section-subtitle">Cambiamos historias con amor y cuidado</p>
        <h1>Rescatamos, rehabilitamos y encontramos hogares llenos de cariño</h1>
        <p>Desde 2020 trabajamos para darle una segunda oportunidad a perros y gatos que han sufrido abandono o maltrato. Cada adopción, donación o voluntario que se suma hace posible que más peludos vuelvan a confiar.</p>
        <div class="hero-cta">
            <a href="{{ route('adopta') }}" class="btn btn-primary">Conoce a los peluditos</a>
            <a href="{{ route('donar') }}" class="btn btn-secondary">Quiero donar</a>
        </div>
        <ul class="tag-list">
            <li>Rescate responsable</li>
            <li>Atención veterinaria</li>
            <li>Adopción consciente</li>
        </ul>
    </div>
    <div class="hero-media">
        <img src="{{ asset('img/rescata_amor.png') }}" alt="Fundación Rescata Amor">
    </div>
</section>

@php($labels = $resumen ?? [])
<section class="content-section soft">
    <h2 class="section-title">Indicadores generales</h2>
    <div class="info-strip">
        @forelse($labels as $label => $value)
            <div>
                <strong>{{ number_format($value) }}</strong>
                {{ ucwords($label) }}
            </div>
        @empty
            <p class="state-message">Aún no hay métricas registradas.</p>
        @endforelse
    </div>
</section>

<section class="content-section">
    <h2 class="section-title">¿Cómo puedes ayudar?</h2>
    <p class="section-subtitle">Tu aporte, sin importar el tamaño, se convierte en alimento, tratamientos, esterilizaciones y hogares definitivos.</p>
    <div class="card-grid">
        <article class="card">
            <h3>Adopción responsable</h3>
            <p>Conoce a Paco, Milo y otros peluditos listos para llenar tu hogar de compañía. Te acompañamos durante todo el proceso.</p>
            <a href="{{ route('adopta') }}" class="btn btn-link">Ver lista de adopción</a>
        </article>
        <article class="card">
            <h3>Hazte voluntario</h3>
            <p>Regala tu tiempo para pasear, socializar o apoyar en jornadas. ¡Cada minuto cuenta para ellos!</p>
            <a href="{{ route('voluntarios') }}" class="btn btn-link">Postularme</a>
        </article>
        <article class="card">
            <h3>Dona hoy</h3>
            <p>Apoya con dinero, suministros médicos, alimentos o siendo padrino. Tenemos múltiples canales seguros.</p>
            <a href="{{ route('donar') }}" class="btn btn-link">Formas de donar</a>
        </article>
    </div>
</section>

<section class="content-section soft">
    <h2 class="section-title">Últimas novedades</h2>
    <div class="responsive-duo">
        <div>
            <h3>Adopciones recientes</h3>
            <div class="list-module">
                @forelse($adopciones as $adopcion)
                    <article>
                        <h4>{{ $adopcion->mascota->nombre_mascota ?? 'Mascota' }} → {{ $adopcion->adoptante->nombres ?? 'Adoptante' }}</h4>
                        <p class="text-muted">{{ $adopcion->fecha_adopcion ?? 'Sin fecha' }}</p>
                        <p>{{ $adopcion->observaciones }}</p>
                    </article>
                @empty
                    <p class="state-message">Todavía no hay adopciones registradas.</p>
                @endforelse
            </div>
        </div>
        <div>
            <h3>Donaciones confirmadas</h3>
            <div class="list-module">
                @forelse($donaciones as $donacion)
                    <article>
                        <h4>{{ $donacion->tipo }} · {{ number_format($donacion->cantidad) }}</h4>
                        <p class="text-muted">{{ $donacion->fecha ?? 'Sin fecha' }}</p>
                        <p>{{ optional($donacion->detalles->first())->descripcion_producto ?? 'Donación registrada.' }}</p>
                    </article>
                @empty
                    <p class="state-message">Aún no registramos donaciones.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
