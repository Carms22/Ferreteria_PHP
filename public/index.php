<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once __DIR__ . "/../src/Core/Database.php";
require_once __DIR__ . "/../src/Core/Auth.php";

use Core\Database;
use Core\Auth;

// Conexión y Auth
$conexion = Database::connect();
$auth = new Auth($conexion);

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
    <nav class="row">
        <a href="index.php?page=maintenance">Mantenimiento</a>
        <a href="index.php?page=catalog/landing">Suministros</a>
        <a href="index.php?page=order">Pedido</a>
        <a href="index.php?page=auth/logout">Cerrar sesión</a>
        <h4><?php if(isset($_SESSION['user_email'])){
                echo $_SESSION['user_email'];
            } ?>

        </h4>
    </nav>

    <div class="content"> 
        <?php
        if (isset($_GET['page'])) {
            // construimos ruta segura
            $page = str_replace(['..', '\\'], '', $_GET['page']); // Limpieza básica
            $file = __DIR__ . "/../views/" . $page . ".php";
            if (!$auth->isAuthenticated()) {
                $page = "auth/login";
                $file = __DIR__ . "/../views/". $page .".php";
                include $file;
                exit;
            }
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
            // Si no hay página en la URL y el usuario no está autenticado → login
            if (!$auth->isAuthenticated()) {
                $page = "auth/login";
                $file = __DIR__ . "/../views/". $page .".php";
                include $file;
            } else {
                // Si ya está autenticado y no hay parámetro → mostrar landing por defecto
                $page = "catalog/landing";
                $file = __DIR__ . "/../views/". $page .".php";
                include $file;
            }
        }
        ?>
    </div>
</body>
</html>
