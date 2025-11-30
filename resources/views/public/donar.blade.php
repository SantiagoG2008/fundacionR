@extends('public.layout')

@section('title', '¿Qué puedes donar? - Fundación Rescata Amor')

@section('content')
<section class="content-section">
    <div class="hero">
        <div class="hero-text">
            <h1>Tu aporte transforma vidas</h1>
            <p>Cada donación cubre tratamientos, jornadas de rescate y programas de adopción. Puedes apoyarnos con dinero, insumos o regalando tu tiempo.</p>
            <a href="{{ route('canales-donacion') }}" class="btn btn-primary">Conoce los canales</a>
        </div>
        <div class="hero-media">
            <img src="{{ asset('img/perro-animado.gif') }}" alt="Perro animado">
        </div>
    </div>
</section>

<section class="content-section soft">
    <h2 class="section-title">Formas de ayudar</h2>
    <p class="section-subtitle">Prioriza lo que puedas aportar; nosotros lo convertimos en bienestar para nuestros peludos.</p>

    <div class="card-grid">
        <article class="card">
            <h3>💰 Donaciones monetarias</h3>
            <p>Gastos veterinarios, medicamentos, esterilizaciones, mejoras locativas y campañas educativas.</p>
        </article>
        <article class="card">
            <h3>🍽️ Alimentos y snacks</h3>
            <p>Croquetas, comida húmeda, snacks funcionales, leche deslactosada y suplementos nutricionales.</p>
        </article>
        <article class="card">
            <h3>🧸 Juguetes y recreación</h3>
            <p>Pelotas, cuerdas, juguetes interactivos, rascadores para gatos y elementos de enriquecimiento ambiental.</p>
        </article>
        <article class="card">
            <h3>🛏️ Descanso y cuidado</h3>
            <p>Camas lavables, mantas, collares, arneses, comederos, bebederos y kits de higiene.</p>
        </article>
        <article class="card">
            <h3>🏥 Suministros médicos</h3>
            <p>Medicamentos veterinarios, jeringas, gasas, termómetros, vitaminas y productos de curación.</p>
        </article>
        <article class="card">
            <h3>⏰ Voluntariado</h3>
            <p>Apoya con paseos, transporte, fotografía, difusión en redes o acompañamiento en eventos.</p>
        </article>
    </div>

    <p>¿Quieres coordinar una donación especial? Escríbenos a <strong>info@rescataamor.org</strong>.</p>
</section>

<section class="content-section">
    <h2 class="section-title">Consulta tus donaciones</h2>
    <p class="section-subtitle">
        Si ya hiciste una donación registrada en el sistema, puedes consultarla ingresando el correo o número de documento
        que usaste como adoptante.
    </p>

    <form method="GET" class="card form-card" style="margin-bottom: 2rem;">
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
        <button type="submit" class="btn btn-primary">Buscar mis donaciones</button>
    </form>

    @isset($donacionesUsuario)
        @if($donacionesUsuario->isEmpty())
            <p class="state-message">No encontramos donaciones asociadas a ese dato.</p>
        @else
            <div class="list-module">
                @foreach($donacionesUsuario as $donacion)
                    @php $det = $donacion->detalles->first(); @endphp
                    <article>
                        <h3>{{ $donacion->tipo }}</h3>
                        <p class="text-muted">
                            {{ $donacion->fecha ? \Carbon\Carbon::parse($donacion->fecha)->format('d/m/Y') : 'Fecha no registrada' }}
                        </p>
                        <p>
                            <strong>Cantidad:</strong>
                            @if($donacion->tipo === 'Monetaria')
                                ${{ number_format($donacion->cantidad, 0, ',', '.') }}
                            @else
                                {{ $donacion->cantidad }} unidades
                            @endif
                        </p>
                        <p><strong>Descripción:</strong> {{ $det->descripcion_producto ?? 'Sin detalle guardado' }}</p>
                    </article>
                @endforeach
            </div>
        @endif
    @endisset
</section>
@endsection
