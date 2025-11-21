<?php
include_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Entity/Category.php";
require_once __DIR__ . "/../../src/Repository/Categories.php";

use Core\Database;
// Conexión
$conexion = Database::connect();

$categories = new Categories($conexion);
if( $categories ){
    $categories->listData();
}else{
    echo "No hay categorías cargadas";
}
?>
