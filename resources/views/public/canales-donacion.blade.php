@extends('public.layout')

@section('title', 'Canales de donación - Fundación Rescata Amor')

@section('content')
<section class="content-section">
    <h1 class="section-title">Canales de donación</h1>
    <p class="section-subtitle">Tu aporte sostiene tratamientos veterinarios, alimentación y campañas de adopción. Elige el canal que prefieras:</p>

    <div class="card-grid">
        <article class="card">
            <h3>🏦 Transferencia bancaria</h3>
            <p><strong>Banco:</strong> Banco de Bogotá</p>
            <p><strong>Cuenta corriente:</strong> 1234567890</p>
            <p><strong>A nombre de:</strong> Fundación Rescata Amor</p>
            <p><strong>NIT:</strong> 900.123.456-7</p>
        </article>

        <article class="card">
            <h3>💳 Tarjeta de crédito o débito</h3>
            <p>Accede a nuestro portal seguro y realiza tu aporte desde cualquier lugar del mundo.</p>
            <p><strong>Monto mínimo:</strong> $10.000 COP</p>
        </article>

        <article class="card">
            <h3>📱 Pago móvil</h3>
            <p><strong>Número:</strong> 300 123 4567</p>
            <p><strong>Referencia:</strong> Donación Rescata Amor</p>
        </article>

        <article class="card">
            <h3>🏪 Donación en efectivo</h3>
            <p>Puedes visitarnos en Calle 123 #45-67, Bogotá, de lunes a viernes entre 8:00 a.m. y 6:00 p.m.</p>
        </article>

        <article class="card">
            <h3>🎁 Donaciones en especie</h3>
            <p>Recibimos alimentos, medicamentos, arenas sanitarias, cobijas, juguetes y suministros veterinarios.</p>
            <p><strong>Contacto:</strong> +57 (1) 234 5678</p>
        </article>
    </div>

    <p><strong>Recuerda:</strong> todas las donaciones son deducibles de impuestos. Envíanos tu comprobante y recibirás el certificado correspondiente.</p>
</section>
@endsection
