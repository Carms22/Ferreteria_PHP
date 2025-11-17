<?php
require_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Core/Auth.php";

use Core\Database;
use Core\Auth;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Obtén la conexión directamente
$pdo = Database::connect();

// Crea el objeto Auth con la conexión
$auth = new Auth($pdo);
$auth->logout();
$page = "auth/login";
$file = __DIR__ . "/../../views/" . $page . ".php";
include $file;
exit; // Se detiene la ejecución para no incluir más HTML
?>