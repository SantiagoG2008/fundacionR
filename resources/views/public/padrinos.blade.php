<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padrinos - Fundación Rescata Amor</title>
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
        <h2>¿Quieres ser padrino?</h2>
        <p>Conviértete en padrino de uno de nuestros peludos y ayúdanos a cubrir sus gastos de alimentación, atención veterinaria y cuidado diario. Como padrino, recibirás actualizaciones regulares sobre el bienestar de tu ahijado.</p>
        
        <p><strong>Beneficios de ser padrino:</strong></p>
        <ul>
            <li>Recibes fotos y actualizaciones de tu ahijado</li>
            <li>Puedes visitar a tu ahijado cuando quieras</li>
            <li>Recibes un certificado de padrinazgo</li>
            <li>Descuentos en eventos de la fundación</li>
            <li>La satisfacción de ayudar a un animal necesitado</li>
        </ul>
        
        <p><strong>Compromiso mensual:</strong></p>
        <ul>
            <li>Padrinazgo básico: $50.000 COP</li>
            <li>Padrinazgo completo: $100.000 COP</li>
            <li>Padrinazgo premium: $200.000 COP</li>
        </ul>
        
        <p>Para más información sobre el programa de padrinazgo, contáctanos en: padrinos@rescataamor.org</p>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
