<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casos Especiales - Fundación Rescata Amor</title>
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
        <h2>Casos Especiales</h2>
        <p>Algunos de nuestros peludos requieren atención especial debido a condiciones médicas, edad avanzada o necesidades específicas. Estos casos especiales necesitan familias comprensivas y comprometidas que puedan brindarles el cuidado que merecen.</p>
        
        <p><strong>Tipos de casos especiales:</strong></p>
        <ul>
            <li>Animales con discapacidades físicas</li>
            <li>Mascotas senior (mayores de 8 años)</li>
            <li>Animales con condiciones médicas crónicas</li>
            <li>Peludos que requieren medicación diaria</li>
            <li>Animales con necesidades dietéticas especiales</li>
        </ul>
        
        <p>Si estás interesado en adoptar un caso especial, contáctanos para conocer más detalles sobre los cuidados específicos que requieren. Estos peludos tienen mucho amor que dar y merecen una familia que los valore por lo especiales que son.</p>
        
        <p>Para más información sobre casos especiales, contáctanos en: casos.especiales@rescataamor.org</p>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
