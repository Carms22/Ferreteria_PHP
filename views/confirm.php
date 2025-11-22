<?php
require_once __DIR__."/../src/Repository/Orders.php";
require_once __DIR__."/../src/Repository/OrderLines.php";
include_once __DIR__ . "/../src/Core/Database.php";

use Core\Database;
$pdo=DataBase::connect();

$ordersRepo = new Orders($pdo);
$orderLinesRepo = new OrderLines($pdo);

if (!empty($_SESSION['lineaProducto']) && isset($_SESSION['user_id'])) {
    try {
        $pdo->beginTransaction();

        // Crear pedido
        $ferreteriaId = $_SESSION['user_id'];
        $pedidoId = $ordersRepo->createOrder($ferreteriaId);

        // Insertar líneas y actualizar stock
        foreach ($_SESSION['lineaProducto'] as $linea) {
            $orderLinesRepo->addOrderLine($pedidoId, $linea['id'], $linea['und']);
            $orderLinesRepo->updateStock($linea['id'], $linea['und']);
        }

        $pdo->commit();

        // Vaciar carrito
        $_SESSION['lineaProducto'] = [];
        echo "<div class='column'>";
        echo "<p style='color:green;'>Pedido confirmado correctamente.</p>";
        echo "<h3>Pedido nº: $pedidoId</h3>";
        echo "<h4>Descripción pedido: </h4>";
        echo "
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Unidades</th>
                </tr>";
        //getPedidolineas
        $filas=$orderLinesRepo->getOrderlineById($pedidoId);
        
        if( $filas ){
            foreach ($filas as $fila) {
                echo "
                    <tr>
                        <td>{$fila['NombreProducto']}</td>
                        <td>{$fila['Descripcion']}</td>
                        <td>{$fila['Peso']}</td>
                        <td>{$fila['Unidades']}</td>
                    </tr>";    
            }
        }
        echo "</table></div>";       
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<p style='color:red;'>Error al confirmar el pedido: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>No hay productos en el carrito.</p>";
}

?>