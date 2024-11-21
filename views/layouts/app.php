<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            include "../partials/head.php";
            echo $extraResources;
        ?>
    </head>
    <body>
        <?php
            include "../partials/header.php";
            echo $content;
            include "../partials/footer.php";
        ?>
    </body>
</html>