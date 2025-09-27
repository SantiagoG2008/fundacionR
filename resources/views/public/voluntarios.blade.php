<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voluntarios - Fundación Rescata Amor</title>
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
        <h2>¿Quieres ser voluntario?</h2>
        <p>¡Únete a nuestro equipo de voluntarios y ayuda a cambiar la vida de nuestros peludos! Como voluntario de Fundación Rescata Amor, tendrás la oportunidad de hacer una diferencia real en la vida de los animales que más lo necesitan.</p>
        
        <p><strong>¿Qué puedes hacer como voluntario?</strong></p>
        <ul>
            <li>Paseo y ejercicio de perros</li>
            <li>Socialización de gatos y perros</li>
            <li>Ayuda en eventos de adopción</li>
            <li>Limpieza y mantenimiento del refugio</li>
            <li>Apoyo en campañas de sensibilización</li>
            <li>Transporte de animales al veterinario</li>
        </ul>
        
        <p><strong>Requisitos:</strong></p>
        <ul>
            <li>Ser mayor de 18 años</li>
            <li>Amor genuino por los animales</li>
            <li>Disponibilidad de tiempo</li>
            <li>Compromiso y responsabilidad</li>
        </ul>
        
        <p>Si estás interesado en ser voluntario, contáctanos en: voluntarios@rescataamor.org</p>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
