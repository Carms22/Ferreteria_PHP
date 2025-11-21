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

        $stmt = $this->pdo->prepare("INSERT INTO pedidos (Fecha, Enviado, ferreteria) VALUES (?, ?, ?)");
        $stmt->execute([$fecha, $enviado, $ferreteria]);

        return (int)$this->pdo->lastInsertId();
    }

    //Obtiene un pedido por su ID.
    public function getOrderById(int $codPed): ?Order {
        $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE CodPed = ?");
        $stmt->execute([$codPed]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Order($row['CodPed'], $row['Fecha'], $row['Enviado'], $row['ferreteria']);
        }
        return null;
    }
}