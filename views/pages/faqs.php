<?php
    include_once "../../app/config.php";
    include_once "../../app/auth.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "../partials/head.php"; ?>

    <style>
        a {
            color: #780828;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilos del encabezado */
        .help-header {
            text-align: center;
            padding: 2rem;
            background-color: #780828;
            color: white;
            border-bottom: 2px solid #951237;
        }

        .help-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .help-header p {
            font-size: 1.2rem;
            margin-top: 0;
        }

        /* Sección de preguntas frecuentes */
        .faq-section {
            padding: 2rem 1rem;
            background-color: #fff;
            margin: 2rem auto;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .faq-section h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #780828;
        }

        .faq-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        .faq-answer {
            font-size: 1rem;
            color: #666;
        }

        /* Sección de información adicional */
        .additional-info {
            padding: 2rem 1rem;
            background-color: #f4f4f4;
            margin: 2rem auto;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .additional-info h2 {
            font-size: 2rem;
            color: #780828;
            margin-bottom: 1rem;
        }

        .additional-info p {
            font-size: 1.1rem;
            color: #555;
        }

        /* Sección de contacto */
        .contact-info {
            padding: 2rem 1rem;
            background-color: #fff;
            margin: 2rem auto;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contact-info h2 {
            font-size: 2rem;
            color: #780828;
            margin-bottom: 1rem;
        }

        .contact-info p {
            font-size: 1.1rem;
            color: #555;
        }

        /* Estilos para la respuesta en dispositivos móviles */
        @media (max-width: 768px) {
            .help-header h1 {
                font-size: 2rem;
            }

            .faq-section,
            .additional-info,
            .contact-info {
                padding: 1rem;
            }

            .faq-question {
                font-size: 1rem;
            }

            .faq-answer {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<?php include_once "../partials/header.php";?>

<main class="help-page">
    <section class="help-header">
        <h1>Centro de Ayuda</h1>
        <p>Encuentra respuestas a las preguntas más frecuentes y cómo usar nuestro servicio.</p>
    </section>

    <section class="faq-section">
        <h2>Preguntas Frecuentes</h2>

        <div class="faq-item">
            <h3 class="faq-question">¿Cómo me registro en la plataforma?</h3>
            <p class="faq-answer">Puedes registrarte haciendo clic en el botón "Registrarse" en la esquina superior derecha de la página. Solo necesitas ingresar tu correo electrónico, una contraseña segura y tu nombre.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question">¿Cómo puedo restablecer mi contraseña?</h3>
            <p class="faq-answer">Si olvidaste tu contraseña, haz clic en "¿Olvidaste tu contraseña?" en la pantalla de inicio de sesión. Luego, te enviaremos un correo electrónico con un enlace para restablecerla.</p>
        </div>

        <div class="faq-item">
            <h3 class="faq-question">¿Cómo se hacen las compras?</h3>
            <p class="faq-answer">Selecciona los productos que deseas comprar, agréguelos a tu carrito y, finalmente, proceda con el pago en la página de "Mi Bolsa". Aceptamos varios métodos de pago.</p>
        </div>
    </section>

    <section class="additional-info">
        <h2>Información adicional</h2>
        <p>Si no encontraste lo que buscas en nuestras preguntas frecuentes, puedes ponerte en contacto con nuestro equipo de soporte.</p>
        <p>También puedes revisar nuestros tutoriales y guías en línea para obtener más detalles sobre cómo usar la plataforma.</p>
    </section>

    <section class="contact-info">
        <h2>Contacto</h2>
        <p>Si tienes alguna duda o necesitas asistencia personalizada, no dudes en contactarnos:</p>
        <p>Email: <a href="mailto:atencionaclientes@ilib.com">atencionaclientes@ilib.com</a></p>
        <p>Teléfono: +52 612 123 1212</p>
    </section>
</main>

<?php include_once "../partials/footer.php"; ?>
<?php include_once "../partials/scripts.php"; ?>
</body>
</html>

