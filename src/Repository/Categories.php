<?php
require_once __DIR__."/../Entity/Category.php";
class Categories{
    /**
     * @var PDO|null Instancia de conexión PDO (puede ser null si no está conectada)
     */
    private PDO $pdo;

    /**
     * Constructor clase Categories
     * 
     * @param PDO Instancia de conexión PDO
     */
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
    //añadir categoría
    public function addCategory(Category $category): bool {
        $cod=$category->getcodCat();
        $nombre=$category->getNombre();
        $descripcion=$category->getDescripcion();
        // 3. Insertar nuevo marcador
        $stmt = $this->pdo->prepare("INSERT INTO categorias VALUES (:CodCad, :Nombre,:Descripcion)");
        $stmt->bindValue(':CodCad', $cod);
        $stmt->bindValue(':Nombre', $nombre);
        $stmt->bindValue(':Descripcion', $descripcion);
        $stmt->execute();

        return true;
    }

        
    /**
     * Lista de forma ordenada las puntuaciones
     * 
     * @return void
     */
    public function listData(){
        $categories = $this->getData();
        echo "<table>
                <thead>
                    <tr>
                        <th>CodCad</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
            ";

            foreach ($categories as $category) {
                echo "<form method='post' action=''>";
                echo "<tr>";
                    echo "<td>" . $category->getCodCat() . "</td>";
                    echo "<td>" . $category->getNombre() . "</td>";
                    echo "<td>" . $category->getDescripcion() . "</td>";
                echo "</tr>";
                echo "</form>";

            }
        
        echo "</tbody></table>";
    }
    
    /**
     * Conseguir los datos de la BD y convertirla en objetosCategoría
     * 
     * @return array
     */
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

    /**
     * Elimina un marcador de la base de datos según nick y puntuación
     *
     * @param string $postNick Nick del jugador
     * @param int $postPto Puntuación del jugador
     * @return int Número de filas eliminadas
     */
    /*
    public function deleteMarcador(string $postNick, int $postPto): int {
        $sql = "DELETE FROM topten WHERE nick = :nick AND score = :score LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nick', $postNick);
        $stmt->bindParam(':score', $postPto);
        $stmt->execute();
        return $stmt->rowCount(); // devuelve cuántas filas se eliminaron
    }
        */
    /**
     * Actualizar un marcador de la base de datos según nick y puntuación
     *
     * @param string $postNick Nick del jugador
     * @param int $postPto Puntuación del jugador
     * @return int Número de filas actualizadas
     */
    /*
    public function updateMarcador(string $postNick, int $postPto): int {
        $sql = "UPDATE topten SET score = :score WHERE nick = :nick LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nick', $postNick);
        $stmt->bindParam(':score', $postPto);
        $stmt->execute();
        return $stmt->rowCount(); // devuelve cuántas filas se actualizaron
    }
        */

}