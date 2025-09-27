<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Fundación Rescata Amor</title>
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
        .contact-form {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #f5d2f2;
            border-radius: 8px;
            font-size: 16px;
        }
        .contact-form button {
            background: linear-gradient(135deg, #f5d2f2, #d4a5d4);
            color: #333;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .contact-info {
            margin-top: 30px;
        }
        .contact-info h3 {
            color: #333;
            margin-bottom: 15px;
        }
        .contact-info p {
            color: #666;
            line-height: 1.6;
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
        <h2>Contáctanos</h2>
        <p>¿Tienes preguntas sobre adopciones, quieres reportar un animal en situación de riesgo, o simplemente deseas conocer más sobre nuestro trabajo? ¡Estamos aquí para ayudarte!</p>
        
        <div class="contact-form">
            <h3>Envíanos un mensaje</h3>
            <form action="{{ route('contacto.store') }}" method="POST">
                @csrf
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <input type="email" name="email" placeholder="Tu email" required>
                <input type="text" name="asunto" placeholder="Asunto" required>
                <textarea name="mensaje" rows="5" placeholder="Tu mensaje" required></textarea>
                <button type="submit">Enviar mensaje</button>
            </form>
        </div>
        
        <div class="contact-info">
            <h3>Información de contacto</h3>
            <p><strong>Teléfono:</strong> +57 (1) 234-5678</p>
            <p><strong>Email:</strong> info@rescataamor.org</p>
            <p><strong>Dirección:</strong> Calle 123 #45-67, Bogotá, Colombia</p>
            <p><strong>Horarios de atención:</strong> Lunes a Viernes 8:00 AM - 6:00 PM</p>
            <p><strong>Emergencias:</strong> +57 300 123-4567 (24/7)</p>
        </div>
    </div>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
