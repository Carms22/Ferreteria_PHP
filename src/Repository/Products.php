<?php 
require_once __DIR__."/../Entity/Product.php";
require_once __DIR__."/../Entity/Category.php";
class Products{
    /**
     * @var PDO|null Instancia de conexión PDO (puede ser null si no está conectada)
     */
    private PDO $pdo;

    /**
     * Constructor clase Products
     * 
     * @param PDO Instancia de conexión PDO
     */
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
                echo "<tr>
                    <td>{$product->getNombre()}</td>
                    <td>{$product->getDescripcion()}</td>
                    <td>{$product->getPeso()}</td>
                    <td>{$product->getStock()}</td>
                    <td>
                    <form method='post' action='index.php?page=order'>
                        <input type='number' name='unidades' id='unidades'>
                        <input type='hidden' name='producto' value='{$product->getNombre()}'>
                        <button type='submit' value='comprar'> Comprar</button>
                    </form>
                    </td>
                </tr>";
            }

            echo "</tbody></table>";

        }
        echo "<div>";
        

    }


    /**
     * Conseguir los datos de la BD y convertirla en objetosCategoría
     * 
     * @return array
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