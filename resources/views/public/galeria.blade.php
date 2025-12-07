@extends('public.layout')

@section('title', 'Galería - Fundación Rescata Amor')

@section('content')
<section class="hero">
    <div class="hero-text">
        <p style="font-size: 1.125rem; line-height: 1.75; color: #374151;">
            En nuestra fundación creemos que cada adopción es una historia única, llena de esperanza, segundas oportunidades y nuevos comienzos. Cada familia que decide abrir las puertas de su hogar transforma no solo la vida de un animal, sino también la suya propia. Son ejemplos de cómo un animal que un día llegó con miedo, dudas o dificultades hoy disfruta de una vida plena, rodeado de afecto y seguridad. Cada adopción es más que un final feliz: es el comienzo de una nueva vida.
        </p>
    </div>
    <div class="hero-media">
        <img src="{{ asset('img/rescata_amor.png') }}" alt="Fundación Rescata Amor">
    </div>
</section>

<section id="galeria" class="content-section soft">
    <h2 class="section-title">Galería</h2>
    <p class="section-subtitle">Algunas imágenes de nuestras jornadas, rescates y adopciones.</p>
    <div class="card-grid">
        @forelse($galeria as $imagen)
            <article class="card">
                <img src="{{ $imagen->ruta_url }}" alt="{{ $imagen->nombre }}">
                <div>
                    <h3>{{ $imagen->nombre }}</h3>
                    @if($imagen->mascota)
                        <p class="text-muted">Mascota: {{ $imagen->mascota->nombre_mascota }}</p>
                    @endif
                </div>
            </article>
        @empty
            <p class="state-message">Todavía no hay imágenes cargadas en la galería.</p>
        @endforelse
    </div>
</section>
@endsection

