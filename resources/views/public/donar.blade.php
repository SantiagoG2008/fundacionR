<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donaciones - Fundación Rescata Amor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Noto+Sans+Hebrew:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Concert+One&family=Noto+Sans+Hebrew:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
        body {
            background-color: #f3f3f3;
        }
        header {
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #535353;
            background-color: #f5d2f2;
        }
        header h1 {
            margin-bottom: 10px;
            font-size: 40px;
            font-style: normal;
            color: #000000;
        }
        .section {
            text-align: center;
            margin: 20px 0;
            font-style:italic;
            color: #000000;
            font-family: "Bad Script", cursive;
            background-color: #f5d2f2;
        }
        .perro_gif{
            width: 50%;
            height: 300px;
        }
        .texto {
            font-size: 20px;
            font-style: italic;
            padding: 15px; 
            max-width: 800px;
            line-height: 30px;
            margin: 0 auto;
            font-weight: bold;
            text-align: center;
        }
        .titulo_lista{
            font-style: normal;
        }
        .titulo_principal {
            font-size: 35px;
            color: #333;
            margin-bottom: 20px;
        }
        footer {
            background-color: #fff;
            padding: 50px;
            font-style: normal;
            text-align: center;
            margin-top: 40px;
            border-top: 2px solid #535353;
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
        .donation-content {
            background: white;
            margin: 20px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .donation-item {
            margin: 20px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            border-left: 5px solid #f5d2f2;
        }
        .donation-item h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .donation-item p {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">← Volver al inicio</a>
    
    <div class="fundacion">
        <h1>FUNDACION RESCATA AMOR</h1>
    </div>
    
    <header>
        <h1 class="titulo_principal">¿Qué puedes donar?</h1>
        <img src="{{ asset('img/perro-animado.gif') }}" alt="Perro Animado" class="perro_gif">
    </header>
    
    <main>
        <section class="section">
            <h2 class="titulo_lista">Formas de ayudar</h2>
            <p class="texto">Tu generosidad puede cambiar la vida de nuestros peludos. Cada donación, por pequeña que sea, nos ayuda a seguir rescatando, cuidando y encontrando hogares para nuestros amigos de cuatro patas.</p>
        </section>
        
        <div class="donation-content">
            <div class="donation-item">
                <h3>💰 Donaciones Monetarias</h3>
                <p>Las donaciones en efectivo nos permiten cubrir gastos veterinarios, medicamentos, alimentos de calidad y mejorar las instalaciones de nuestros refugios.</p>
            </div>
            
            <div class="donation-item">
                <h3>🍽️ Alimentos y Snacks</h3>
                <p>Donaciones de croquetas, comida húmeda, snacks saludables y golosinas para perros y gatos de todas las edades.</p>
            </div>
            
            <div class="donation-item">
                <h3>🧸 Juguetes y Entretenimiento</h3>
                <p>Pelotas, cuerdas, juguetes interactivos, rascadores para gatos y cualquier elemento que mantenga a nuestros peludos felices y activos.</p>
            </div>
            
            <div class="donation-item">
                <h3>🛏️ Accesorios y Cuidado</h3>
                <p>Camas, mantas, collares, correas, comederos, bebederos, champús, cepillos y productos de higiene para mascotas.</p>
            </div>
            
            <div class="donation-item">
                <h3>🏥 Suministros Médicos</h3>
                <p>Medicamentos veterinarios, vendas, gasas, termómetros, jeringas y cualquier material médico que pueda necesitarse.</p>
            </div>
            
            <div class="donation-item">
                <h3>⏰ Tu Tiempo</h3>
                <p>Voluntariado para pasear perros, limpiar refugios, ayudar en eventos de adopción o simplemente dar cariño a nuestros peludos.</p>
            </div>
        </div>
    </main>
    
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
        <p>Para más información sobre donaciones, contáctanos en: info@rescataamor.org</p>
    </footer>
</body>
</html>
