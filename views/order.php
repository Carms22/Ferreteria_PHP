<?php
echo "<div class='column'>";

if (isset($_POST['unidades']) && (int)$_POST['unidades'] > 0 && isset($_POST['idProducto']) && isset($_POST['producto'])) {
    // Si no existe la sesión, inicialízala como array vacío
    if (!isset($_SESSION['lineaProducto'])) {
        $_SESSION['lineaProducto'] = [];
    }

    $productoExiste = false;
    // Recorremos por referencia para poder modificar el array original
    foreach($_SESSION['lineaProducto'] as &$linea){
        if($linea['id'] == $_POST['idProducto']){
            $linea['und'] += (int)$_POST['unidades'];
            $productoExiste = true;
            break;
        }
    }
    //Si no existe el producto lo añado
    if(!$productoExiste){
         $_SESSION['lineaProducto'][] = [
            "id" => $_POST['idProducto'],
            "nombre" => $_POST['producto'],
            "und" => $_POST['unidades']
        ];
    }
       
    unset($linea); // Buenas prácticas: romper referencia
    var_dump($_SESSION['lineaProducto']);
    //echo $_POST['producto']."</br>";
    //echo $_POST['unidades']."</br>";
}

// Si se envía la acción de eliminar
if (isset($_POST['und_eliminar']) && isset($_POST['index'])) {
    $index = (int)$_POST['index'];
    $nEliminar= (int)$_POST['und_eliminar'];
    if (isset($_SESSION['lineaProducto'][$index])) {
        //resto las unidades introducidas
        $_SESSION['lineaProducto'][$index]['und'] -= $nEliminar;

        // Si las unidades quedan en 0 o menos, elimino la línea
        if ($_SESSION['lineaProducto'][$index]['und'] <= 0) {
            unset($_SESSION['lineaProducto'][$index]);
            $_SESSION['lineaProducto'] = array_values($_SESSION['lineaProducto']);
        }

    }
}
// Mostrar productos
if (isset($_SESSION['lineaProducto']) && count($_SESSION['lineaProducto']) > 0) {
    echo "<h3>Productos en tu pedido:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Unidades</th><th>Eliminar</th></tr>";

    foreach ($_SESSION['lineaProducto'] as $index => $producto) {
        echo "<tr>";
            echo "<td>{$producto['id']}</td>";
            echo "<td>{$producto['nombre']}</td>";
            echo "<td>{$producto['und']}</td>";
            echo "<td> 
                <form method='POST' style='display:inline;'>
                    <input type='number' name='und_eliminar' min='1' max='{$producto['und']}' required>
                    <input type='hidden' name='index' value='{$index}'>
                    <button type='submit'>Eliminar</button>
                </form>
                </td>";
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "No hay productos seleccionados";
}

echo "</div>";
