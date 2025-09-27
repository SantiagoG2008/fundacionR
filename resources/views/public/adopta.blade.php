<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopta - Fundación Rescata Amor</title>
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
        .lista_perros {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contenedor_perros {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 15px;
            padding: 15px;
            width: 50%;
            text-align: center;
            margin: 20px;
        }
        .contenedor_perros img {
            max-width: 30%;
            border-radius: 10px;
            object-fit: cover;
            height: 250px;
        }
        .contenedor_perros h3 {
            font-style: normal;
            color: #000000;
            font-size: 30px;
        }
        footer {
            background-color: #fff;
            padding: 50px;
            font-style: normal;
            text-align: center;
            margin-top: 40px;
            border-top: 2px solid #535353;
        }
        .milo{
            height: 300px;
            width: 100%;
        }
        .paco{
            height: 300px;
            width: 100%;
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
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">← Volver al inicio</a>
    
    <div class="fundacion">
        <h1>FUNDACION RESCATA AMOR</h1>
        <h1 class="tit2">El amor cambia vidas</h1>
    </div>
   
    <main>
        <section class="section">
            <h2 class="titulo_lista">Lista de peluditos en adopción</h2>
            <p class="texto">Nuestros peludos están buscando un hogar permanente y lleno de amor. Una vez que hayas encontrado al compañero ideal para adoptar, revisa los requisitos y completa el formulario correspondiente. ¡Estamos ansiosos por ayudarte a encontrar a tu nuevo mejor amigo!</p>
        </section>
        <section>
            <div class="lista_perros">
                <div class="contenedor_perros">
                    <img src="{{ asset('img/perro3.jpg') }}" alt="Paco" class="paco">
                    <h3>Paco - 9 años</h3>
                    <p>¡Hola! Me llamo Paco y soy un perrito lleno de energía y amor. Tengo un pelaje suavecito y unas orejas grandes que siempre están atentas para escuchar cada palabra que me digas. Lo que más me gusta en el mundo es correr al aire libre, jugar a la pelota y, sobre todo, ¡recibir muchos mimos! Soy muy cariñoso y prometo que si me adoptas, seré tu mejor amigo para siempre. A veces me pongo un poco nervioso con los ruidos fuertes, pero si me das una caricia, me tranquilizo de inmediato. Estoy buscando una familia que quiera compartir aventuras conmigo. ¿Te gustaría ser esa persona especial? ¡Adóptame y hagamos una vida llena de momentos felices juntos!</p>
                </div>
                <div class="contenedor_perros">
                    <img src="{{ asset('img/perro4.jpg') }}" alt="Milo" class="milo">
                    <h3>Milo - 5 años</h3>
                    <p>¡Hola, humano! Soy Milo, un gatito con mucha curiosidad y una personalidad única. Me encanta explorar cada rincón de la casa, y cuando termino mis aventuras diarias, busco un lugar cómodo para acurrucarme. Si me adoptas, te prometo muchas horas de ronroneos y compañía. Aunque soy un poquito independiente, siempre estaré cerca para hacerte compañía. Me gusta que me rasquen detrás de las orejas y, de vez en cuando, jugar con una pelota o una cuerda. Si necesitas un amigo que te haga sonreír cada día, aquí estoy yo, esperando encontrar mi hogar ideal. ¿Te animas a conocerme? ¡Yo también quiero una familia a quien amar!</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>Fundación Rescata Amor © 2024</p>
    </footer>
</body>
</html>
