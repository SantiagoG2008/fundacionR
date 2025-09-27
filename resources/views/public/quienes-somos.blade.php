<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quiénes somos? - Fundación Rescata Amor</title>
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
        <h2>¿Quiénes somos?</h2>
        <p>Fundación Rescata Amor es una organización sin ánimo de lucro fundada en 2020 con el propósito de brindar una segunda oportunidad a los animales que han sido víctimas del abandono, maltrato o negligencia.</p>
        
        <p>Nuestra misión es rescatar, rehabilitar y encontrar hogares permanentes para perros y gatos en situación de vulnerabilidad, promoviendo la adopción responsable y el bienestar animal en nuestra comunidad.</p>
        
        <p>Creemos firmemente que cada animal merece amor, cuidado y respeto. Trabajamos incansablemente para cambiar la realidad de aquellos que no tienen voz, proporcionándoles atención veterinaria, alimentación adecuada, socialización y, sobre todo, mucho amor.</p>
        
        <p>Nuestro equipo está conformado por veterinarios, voluntarios apasionados y personas comprometidas con la causa animal. Juntos, hemos logrado rescatar y encontrar hogares para más de 500 animales desde nuestros inicios.</p>
        
        <p>Si compartes nuestra visión y quieres ser parte del cambio, te invitamos a conocer más sobre nuestras actividades, adoptar responsablemente o apoyar nuestra labor a través de donaciones o voluntariado.</p>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
