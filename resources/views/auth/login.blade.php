<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fundación Rescata Amor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Concert+One&family=Noto+Sans+Hebrew:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Concert One", sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5d2f2, #e8c5e8);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }
        
        .login-container h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }
        
        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .login-container input {
            padding: 15px;
            border: 2px solid #f5d2f2;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .login-container input:focus {
            outline: none;
            border-color: #d4a5d4;
        }
        
        .login-container button {
            background: linear-gradient(135deg, #f5d2f2, #d4a5d4);
            color: #333;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .login-container button:hover {
            transform: translateY(-2px);
        }
        
        .login-container a {
            color: #d4a5d4;
            text-decoration: none;
            font-size: 14px;
        }
        
        .login-container a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">← Volver al inicio</a>
    
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="logo">
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->has('credentials'))
            <div class="alert alert-error">
                {{ $errors->first('credentials') }}
            </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="usuario" placeholder="Usuario" value="{{ old('usuario') }}" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        
    </div>
</body>
</html>
