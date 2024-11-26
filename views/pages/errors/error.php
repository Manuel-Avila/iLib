<?php
    include "../../../app/config.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "../../partials/head.php"; ?>
</head>
<body>
    <?php include "../../partials/header.php";?>
    <div style="font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 50vh; margin: 0;">
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Error</h1>
        <p style="font-size: 1rem; margin-bottom: 1.5rem; text-align: center;">Lo sentimos, algo salió mal. Por favor, inténtalo de nuevo más tarde.</p>
        <a href="<?=BASE_PATH?>" style="text-decoration: none; color: #007bff; font-weight: bold; border: 1px solid #007bff; padding: 0.5rem 1rem; border-radius: 4px; transition: background-color 0.3s, color 0.3s;">Volver a Inicio</a>
    </div>
    <?php include "../../partials/footer.php";?>
</body>
</html>

