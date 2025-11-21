<?php
echo "<div class='column'>";

if (isset($_POST['unidades']) && isset($_POST['idProducto']) && isset($_POST['producto'])) {
    // Si no existe la sesión, inicialízala como array vacío
    if (!isset($_SESSION['lineaProducto'])) {
        $_SESSION['lineaProducto'] = [];
    }

    // Añadir el producto como un nuevo elemento
    $_SESSION['lineaProducto'][] = [
        "id" => $_POST['idProducto'],
        "nombre" => $_POST['producto'],
        "und" => $_POST['unidades']
    ];

    var_dump($_SESSION['lineaProducto']);
    //echo $_POST['producto']."</br>";
    //echo $_POST['unidades']."</br>";
}

// Si se envía la acción de eliminar
if (isset($_POST['eliminar']) && is_numeric($_POST['eliminar'])) {
    $index = (int)$_POST['eliminar'];
    if (isset($_SESSION['lineaProducto'][$index])) {
        unset($_SESSION['lineaProducto'][$index]);
        // Reindexamos el array para evitar huecos
        $_SESSION['lineaProducto'] = array_values($_SESSION['lineaProducto']);
    }
}
// Mostrar productos
if (isset($_SESSION['lineaProducto']) && count($_SESSION['lineaProducto']) > 0) {
    echo "<h3>Productos en tu pedido:</h3>";
    echo "<form method='POST'>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Unidades</th><th>Eliminar</th></tr>";

    foreach ($_SESSION['lineaProducto'] as $index => $producto) {
        echo "<tr>";
            echo "<td>{$producto['id']}</td>";
            echo "<td>{$producto['nombre']}</td>";
            echo "<td>{$producto['und']}</td>";
            echo "<td>
                    <button type='submit' name='eliminar' value='{$index}'>Eliminar</button>
                </td>";
        echo "</tr>";
    }

    
    echo "</table>";
    echo "</form>";

} else {
    echo "No hay productos seleccionados";
}

echo "</div>";
