<?php
session_start();

include_once __DIR__ . "/../views/header.php";
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
    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            // construimos ruta segura
            $page = basename($_GET['page']); // Seguridad: evita rutas maliciosas
            $file = __DIR__ . "/../views/". $page .".php";
            /**
             * __DIR__ → /var/www/html/T1_Practica2_Ferreteria/public
             * "/../views/" → sube un nivel (..) y entra en views/
             * Resultado final → /var/www/html/T1_Practica2_Ferreteria/views/auth/logout.php
             */
            
            // Páginas públicas
            $publicPages = ['auth/login', 'auth/logout'];
            
            // Si la página no es pública y el usuario no está autenticado → redirigir al login
            if (!in_array($page, $publicPages) && 
                !$auth->isAuthenticated()) {
                $page="auth/login";
                $file= __DIR__ . "/../views/". $page .".php";
            }

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
