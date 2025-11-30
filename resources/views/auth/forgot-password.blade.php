<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña - Fundación Rescata Amor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #d67ab1;
            --primary-light: #f8d9ec;
            --text: #2f2f2f;
        }
        * { box-sizing: border-box; }
        body {
            font-family: "Concert One", sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5d2f2, #e8c5e8);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .auth-card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            border-radius: 18px;
            box-shadow: 0 20px 35px rgba(0,0,0,0.12);
            padding: 40px 32px;
            text-align: center;
        }
        .auth-card h1 {
            margin: 0 0 12px;
            color: var(--text);
            font-size: 28px;
        }
        .auth-card p {
            margin: 0 0 24px;
            color: #5c5c5c;
            line-height: 1.5;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 10px;
            border: 2px solid var(--primary-light);
            font-size: 15px;
            transition: border-color 0.2s;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
        }
        button {
            background: linear-gradient(135deg, var(--primary), #f5d2f2);
            border: none;
            color: var(--text);
            font-size: 16px;
            padding: 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s;
            font-weight: bold;
        }
        button:hover { transform: translateY(-2px); }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #e6ffed;
            color: #046c4e;
            border: 1px solid #b7f5c4;
        }
        .alert-error {
            background: #ffe6e9;
            color: #a12844;
            border: 1px solid #f5b7c2;
        }
        .auth-links {
            margin-top: 24px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .auth-links a {
            color: var(--primary);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1>Restablecer contraseña</h1>
        <p>Actualiza tu contraseña directamente desde el sistema. Solo ingresa tu correo y la nueva clave.</p>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0; padding-left: 18px; text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update.manual') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
            <input type="password" name="password" placeholder="Nueva contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            <button type="submit">Actualizar contraseña</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
            <a href="{{ route('home') }}">Ir al sitio público</a>
        </div>
    </div>
</body>
</html>


