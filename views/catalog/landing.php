<?php
include_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Core/Auth.php";
require_once __DIR__ . "/../../src/Entity/Category.php";
require_once __DIR__ . "/../../src/Repository/Categories.php";

use Core\Database;


// Conexión y Auth
$conexion = Database::connect();

$categories = new Categories($conexion);
if( $categories ){
    $categories->listData();
}

?>
<h2>Landing--> suministros</h2>