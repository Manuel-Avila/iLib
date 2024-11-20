<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            include "head.php";
            echo $extraResources;
        ?>
    </head>
    <body>
        <?php
            include "header.php";
            echo $content;
            include "footer.php"; 
        ?>
    </body>
</html>