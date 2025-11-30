@extends('public.layout')

@section('title', 'Programa de padrinos - Fundación Rescata Amor')

@section('content')
<section class="content-section narrow">
    <h1 class="section-title">Programa de padrinazgo</h1>
    <p class="section-subtitle">Ayuda a cubrir alimentación, controles médicos y cuidado diario de un peludito. Recibirás reportes y podrás visitarlo cuando quieras.</p>

    <h3>Beneficios</h3>
    <ul class="list-check">
        <li>Actualizaciones mensuales con fotos y avances</li>
        <li>Certificado de padrinazgo y reconocimiento en redes</li>
        <li>Visitas programadas para compartir tiempo con tu ahijado</li>
        <li>Descuentos en eventos y productos de la fundación</li>
    </ul>

    <h3>Planes sugeridos</h3>
    <div class="card-grid">
        <article class="card">
            <h4>Padrino básico</h4>
            <p>$50.000 COP al mes · Cubre alimento premium.</p>
        </article>
        <article class="card">
            <h4>Padrino completo</h4>
            <p>$100.000 COP al mes · Incluye controles veterinarios.</p>
        </article>
        <article class="card">
            <h4>Padrino premium</h4>
            <p>$200.000 COP al mes · Apoya tratamientos y rehabilitación.</p>
        </article>
    </div>

    <p>¿Listo para apadrinar? Escríbenos a <strong>padrinos@rescataamor.org</strong> y te compartiremos el catálogo de peluditos que esperan un padrino.</p>
</section>
@endsection
