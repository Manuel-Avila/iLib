<?php
define('BASE_PATH', '/iLib/'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Olvidaste tu contraseña? - Librería</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)), url('public/img/backgroundLogin.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            margin: 0;
        }

        .forgot-password-container {
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

        .links {
            display: flex;
            justify-content: center;
            margin-top: 15px;
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
            .forgot-password-container {
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
</head>
<body>
    <div class="forgot-password-container">
        <img src="public/img/logo.png" alt="Logo" class="logo">
        <h1>¿Olvidaste tu contraseña?</h1>
        <p>Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña.</p>
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
            
            <button type="submit" class="primary-button">Enviar instrucciones</button>
        </form>

        <div class="links">
            <a href="<?=BASE_PATH?>login">Volver a Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>
