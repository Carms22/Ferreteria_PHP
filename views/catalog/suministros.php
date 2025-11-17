<?php
include_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Entity/Product.php";
require_once __DIR__ . "/../../src/Repository/Products.php";

use Core\Database;

// Conexión
$conexion = Database::connect();

$products = new Products($conexion);
if( $products ){
    $products->listData();
}else{
    echo "No hay productos cargados";
}

?>


<h2>Suministros</h2>