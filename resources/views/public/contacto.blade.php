@extends('public.layout')

@section('title', 'Contacto - Fundación Rescata Amor')

@section('content')
<section class="content-section">
    <h1 class="section-title">Estamos aquí para ayudarte</h1>
    <p class="section-subtitle">Si tienes preguntas sobre adopciones, quieres reportar un caso o deseas sumarte como voluntario, escríbenos y te responderemos lo antes posible.</p>

    <div class="contact-layout">
        <article class="card form-card">
            <h3>Envíanos un mensaje</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(isset($mascotaSeleccionada))
                <p class="text-muted" style="margin-bottom: 0.75rem;">
                    Estás enviando una solicitud de adopción por <strong>{{ $mascotaSeleccionada->nombre_mascota }}</strong>.
                </p>
            @endif
            <form action="{{ route('contacto.store') }}" method="POST">
                @csrf
                <input type="text" name="nombre" placeholder="Tu nombre" value="{{ old('nombre') }}" required>
                <input type="email" name="email" placeholder="Tu correo" value="{{ old('email') }}" required>
                <input
                    type="text"
                    name="asunto"
                    placeholder="Asunto"
                    value="{{ old('asunto', isset($mascotaSeleccionada) ? 'Solicitud de adopción de ' . $mascotaSeleccionada->nombre_mascota : '') }}"
                    required
                >
                <textarea name="mensaje" placeholder="Tu mensaje" required>{{ old('mensaje') }}</textarea>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </article>

        <article class="card info-card">
            <h3>Datos de contacto</h3>
            <p><strong>Teléfono fijo:</strong> +57 (1) 234 5678</p>
            <p><strong>WhatsApp emergencias:</strong> +57 300 123 4567 (24/7)</p>
            <p><strong>Email:</strong> info@rescataamor.org</p>
            <p><strong>Dirección:</strong> Calle 123 #45-67, Bogotá, Colombia</p>
            <p><strong>Horarios:</strong> Lunes a viernes 8:00 a.m. - 6:00 p.m.</p>
        </article>
    </div>
</section>
@endsection
