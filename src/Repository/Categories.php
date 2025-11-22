<?php
require_once __DIR__."/../Entity/Category.php";
class Categories{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getNameById($codCat){
        $categories = $this->getData();
        foreach ($categories as $category) {
            if($category->getCodCad() === $codCat){
                return $category->getNombre();
            }
        }
    }

    public function listData(){
        $categories = $this->getData();
        echo "<div class='column'>";
        echo "<h2>Suministros disponibles por categoría</h2>";
        /*echo "<table>
                <thead>
                    <tr>
                        <!--<th>CodCad</th>-->
                        <!--<th>Nombre</th>-->
                        <!--<th>Descripción</th>-->
                    </tr>
                </thead>
                <tbody>
            ";
        */
            foreach ($categories as $category) {
                echo "<form method='post' action=''>";
                echo "<tr>";
                    //echo "<td>" . $category->getCodCat() . "</td>";
                    echo "<td>" . $category->getNombre() . "</td>";
                    //echo "<td>" . $category->getDescripcion() . "</td>";
                echo "</tr>";
                echo "</form>";

            }
        
        echo "</tbody></table></div>";
    }

    public function getData(): array {
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