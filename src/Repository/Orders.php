<?php
require_once __DIR__."/../Entity/Order.php";

class Orders {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    //Inserta un nuevo pedido y devuelve su ID.
    public function createOrder(int $ferreteria): int {
        $fecha = date('Y-m-d H:i:s');
        $enviado = 0;
        $sql="INSERT INTO pedidos (Fecha, Enviado, ferreteria) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1,$fecha);
        $stmt->bindParam(2,$enviado);
        $stmt->bindParam(3,$ferreteria);
        $stmt->execute();

        return (int)$this->pdo->lastInsertId();
    }

    //Obtiene un pedido por su ID.
    public function getOrderById(int $codPed): ?Order {
        $sql="SELECT * FROM pedidos WHERE CodPed = $codPed";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Order($row['CodPed'], $row['Fecha'], $row['Enviado'], $row['ferreteria']);
        }
        return null;
    }
}