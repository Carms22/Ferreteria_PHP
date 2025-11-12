<?php
session_start();
include_once __DIR__ . "/../views/header.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/style.css">
    <title>Ferretería</title>
</head>
<body>
    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            // construimos ruta segura
            $page = $_GET['page'];
            $file = __DIR__ . "/../views/" . $page . ".php";
            /**
             * __DIR__ → /var/www/html/T1_Practica2_Ferreteria/public
             * "/../views/" → sube un nivel (..) y entra en views/
             * Resultado final → /var/www/html/T1_Practica2_Ferreteria/views/auth/logout.php
             */

            if (file_exists($file)) {
                include $file;
            } else {
                echo "<h2>Página no encontrada</h2>";
            }
        } else {

            
            echo "<h1>Bienvenido a la Ferretería</h1>";
        }
        ?>
    </div>
</body>
</html>
