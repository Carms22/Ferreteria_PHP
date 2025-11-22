<?php 
require_once __DIR__."/../Entity/Product.php";
require_once __DIR__."/../Entity/Category.php";
class Products{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function listData(){
        $datos = $this->getData();
        $categories = $this->getCategories();
        
        // Crear mapa [id => nombre] para acceso rápido
        $categoriesMap = [];
        foreach ($categories as $cat) {
            $categoriesMap[$cat->getCodCat()] = $cat->getNombre();
        }
        
        // Agrupar productos por categoría
        $productosPorCategoria = [];
        foreach ($datos as $product) {
            $idCat = $product->getCategoria();
            $productosPorCategoria[$idCat][] = $product;
        }

        echo "<div class'column'>";
        //porductos agrupados por categoría:
        foreach ($productosPorCategoria as $idCat => $productos) {
            
            $nombreCat = $categoriesMap[$idCat] ?? 'Sin categoría';
            echo "<h2>$nombreCat</h2>";

            echo "<table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Peso</th>
                        <th>Stock</th>
                        <th>Comprar</th>
                    </tr>
                </thead>
                <tbody>
            ";
            
            foreach ($productos as $product) {
                $stockDisponible = $product->getStock();//control de stock
                $unidadesEnCarrito = 0;

                // Comprobar si el producto ya está en el carrito y coger unidadesEnCarrito
                if (isset($_SESSION['lineaProducto'])) {
                    foreach ($_SESSION['lineaProducto'] as $linea) {
                        if ($linea['id'] == $product->getCodProd()) {
                            $unidadesEnCarrito = $linea['und'];
                            break;
                        }
                    }
                }

                // Calcular stock restante
                $stockRestante = $stockDisponible - $unidadesEnCarrito;
                
                echo "<tr>
                    <td>{$product->getNombre()}</td>
                    <td>{$product->getDescripcion()}</td>
                    <td>{$product->getPeso()}</td>
                    <td>{$product->getStock()}</td>
                    <td>";
                if ($stockRestante > 0) {
                echo "<form method='post' action='index.php?page=order'>
                        <input type='number' name='unidades' id='unidades' min='1' max='{$stockRestante}' required>
                        <input type='hidden' name='producto' value='{$product->getNombre()}'>
                        <input type='hidden' name='idProducto' value='{$product->getCodProd()}'>
                        <button type='submit' value='comprar'> Comprar</button>
                    </form>
                    </td>
                </tr>";
                
                } else {
                    echo "<span style='color:red;'>Sin stock disponible</span>";
                }
            }
            echo "</tbody></table>";
        }
        echo "<div>";
    }


    /**
     * Conseguir los datos de la BD y convertirla en objetosProducto
     */
    public function getData(): array {
        $ssql = 'SELECT * FROM productos;';
        try {
            $productos = [];//array de obejto Categoría
            $stmt = $this->pdo->query($ssql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);//convierte el resultado en un array limpio.
            
            foreach ($filas as $fila) {
                $productos[] = new Product($fila['CodProd'], $fila['Nombre'], $fila['Descripcion'], $fila['Peso'], $fila['Stock'], $fila['Categoria']);
            }
            return $productos;

        } catch (PDOException $e) {
            error_log("Error al obtener datos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Conseguir los datos de la BD y convertirla en objetosCategoria para agrupar por categorías en getData de productos
     */
    public function getCategories(): array {
        $ssql = 'SELECT * FROM categorias;';
        try {
            $categories = [];//array de obejto Categoría
            $stmt = $this->pdo->query($ssql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);//convierte el resultado en un array limpio.
            
            foreach ($filas as $fila) {
                $categories[] = new Category($fila['CodCat'], $fila['Nombre'], $fila['Descripcion']);
            }
            return $categories;

        } catch (PDOException $e) {
            error_log("Error al obtener datos: " . $e->getMessage());
            return [];
        }
    }

}


?>