<?php
    include_once "../../../app/config.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "../../partials/head.php"; ?>
</head>
<body>
    <?php include_once "../../partials/header.php";?>
    <div style="font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 50vh; margin: 0;">
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Panel Admin</h1>
        <p style="font-size: 1rem; margin-bottom: 1.5rem; text-align: center;">Aqui se supone que va el panel de admin</p>
        <a href="<?=BASE_PATH?>" style="text-decoration: none; color: #780828; font-weight: bold; border: 1px solid #780828; padding: 0.5rem 1rem; border-radius: 4px; transition: background-color 0.3s, color 0.3s;">Volver a Inicio</a>
    </div>
    <?php include_once "../../partials/footer.php";?>
</body>
</html>

