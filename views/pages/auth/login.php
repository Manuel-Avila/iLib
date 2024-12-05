<?php
define('BASE_PATH', '/iLib/'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Librería</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)), url('<?=BASE_PATH?>public/img/backgroundLogin.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .logo {
            width: 120px;
            height: auto;
            margin: 0 auto 1.5rem;
            display: block;
        }

        h1 {
            color: #8b1538;
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        p {
            color: #6b7280;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
        }

        input {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 0.95rem;
        }

        input:focus {
            outline: none;
            border-color: #8b1538;
            box-shadow: 0 0 0 2px rgba(139, 21, 56, 0.1);
        }

        .primary-button {
            background-color: #8b1538;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s;
            width: 100%;
            margin-bottom: 10px;
        }

        .primary-button:hover {
            background-color: #6d102b;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #6b7280;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #d1d5db;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .google-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .google-button:hover {
            background-color: #f3f4f6;
        }

        .google-icon {
            width: 18px;
            height: 18px;
            margin-right: 8px;
        }

        .links {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 0.875rem;
        }

        .links a {
            color: #8b1538;
            text-decoration: none;
            transition: color 0.2s;
        }

        .links a:hover {
            color: #6d102b;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .logo {
                width: 100px;
            }

            h1 {
                font-size: 1.3rem;
            }

            p {
                font-size: 0.8rem;
            }

            input, button {
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Enlace al CSS de Alertify.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <!-- Enlace a los estilos temáticos de Alertify.js (opcional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <!-- Enlace al JavaScript de Alertify.js -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>
<body>
    <div class="login-container">
        <img src="<?=BASE_PATH?>public/img/logo.png" alt="Logo" class="logo">
        <h1>Iniciar Sesión</h1>
        <p>Ingresa a tu cuenta para acceder a tu biblioteca</p>
        <form>
            <label for="email">Correo electrónico</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                required 
                placeholder="tu@ejemplo.com"
                autocomplete="email"
            >
            
            <label for="password">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                autocomplete="current-password"
            >

            <button id="login-bt" class="primary-button">Iniciar Sesión</button>
            
            <div class="links">
                <a href="<?=BASE_PATH?>forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            

            <div class="links" style="justify-content: center; margin-bottom: 15px;">
                <span>¿No tienes una cuenta? <a href="<?=BASE_PATH?>register" style="color: #8b1538;">Regístrate aquí</a></span>
            </div>
        </form>

        <div class="divider">O</div>

        <button id="google-bt" class="google-button">
            <img src="https://www.google.com/favicon.ico" alt="Google" class="google-icon">
            Continuar con Google
        </button>
    </div>

    <script type="module" src="<?=BASE_PATH?>public/js/login.js"></script>
</body>
</html>