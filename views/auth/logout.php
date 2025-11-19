<?php
require_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Core/Auth.php";

use Core\Database;
use Core\Auth;

// Obtén la conexión directamente
$pdo = Database::connect();

// Crea el objeto Auth con la conexión
$auth = new Auth($pdo);
$auth->logout();
//Enlace a login::
echo "<div class'column'>";
echo "<h2>Te has desconectado</h2>";
echo "<h3><a href='index.php?page=auth/login' >Ir a Login </a></h3>";
echo "</div>";
//$page = "auth/login";
////$file = __DIR__ . "/../../views/" . $page . ".php";
//include $file;
//exit; // Se detiene la ejecución para no incluir más HTML
?>