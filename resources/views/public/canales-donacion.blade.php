<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canales de Donación - Fundación Rescata Amor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Concert+One&family=Noto+Sans+Hebrew:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Concert One", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }
        .fundacion{
            text-align: center;
            line-height: 1.3;
            margin-top: 14px;
            font-family: "Concert One", sans-serif;
        }
        .tit2{
            font-family: "Bad Script", cursive;
            font-size: 25px;
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            z-index: 1000;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .content {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .content h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .content p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .donation-channel {
            background: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            border-left: 5px solid #f5d2f2;
        }
        .donation-channel h3 {
            color: #333;
            margin-bottom: 10px;
        }
        footer {
            background-color: #fff;
            padding: 50px;
            font-style: normal;
            text-align: center;
            margin-top: 40px;
            border-top: 2px solid #535353;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">← Volver al inicio</a>
    
    <div class="fundacion">
        <h1>FUNDACION RESCATA AMOR</h1>
        <h1 class="tit2">El amor cambia vidas</h1>
    </div>
    
    <div class="content">
        <h2>Canales de Donación</h2>
        <p>Tu apoyo es fundamental para continuar nuestra labor. Puedes hacer donaciones a través de los siguientes canales:</p>
        
        <div class="donation-channel">
            <h3>🏦 Transferencia Bancaria</h3>
            <p><strong>Banco:</strong> Banco de Bogotá</p>
            <p><strong>Cuenta Corriente:</strong> 1234567890</p>
            <p><strong>A nombre de:</strong> Fundación Rescata Amor</p>
            <p><strong>NIT:</strong> 900.123.456-7</p>
        </div>
        
        <div class="donation-channel">
            <h3>💳 Tarjeta de Crédito/Débito</h3>
            <p>Puedes hacer donaciones con tarjeta de crédito o débito a través de nuestro sistema seguro de pagos en línea.</p>
            <p><strong>Monto mínimo:</strong> $10.000 COP</p>
        </div>
        
        <div class="donation-channel">
            <h3>📱 Pago Móvil</h3>
            <p><strong>Número:</strong> 300 123-4567</p>
            <p><strong>Referencia:</strong> Donación Rescata Amor</p>
        </div>
        
        <div class="donation-channel">
            <h3>🏪 Pago en Efectivo</h3>
            <p>Puedes hacer donaciones en efectivo directamente en nuestras instalaciones:</p>
            <p><strong>Dirección:</strong> Calle 123 #45-67, Bogotá</p>
            <p><strong>Horario:</strong> Lunes a Viernes 8:00 AM - 6:00 PM</p>
        </div>
        
        <div class="donation-channel">
            <h3>🎁 Donaciones en Especie</h3>
            <p>También recibimos donaciones de alimentos, medicamentos, juguetes y accesorios para mascotas.</p>
            <p>Para coordinar donaciones en especie, contáctanos al: +57 (1) 234-5678</p>
        </div>
        
        <p><strong>Nota:</strong> Todas las donaciones son deducibles de impuestos. Te enviaremos el certificado correspondiente por email.</p>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
