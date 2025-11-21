<?php
require_once __DIR__."/../Entity/Orderline.php";

class OrderLines {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    //Inserta una línea de pedido.
    public function addOrderLine(int $pedidoId, int $productoId, int $unidades): void {
        $stmt = $this->pdo->prepare("INSERT INTO pedidosproductos (Pedido, Producto, Unidades) VALUES (?, ?, ?)");
        $stmt->execute([$pedidoId, $productoId, $unidades]);
    }

    //Actualiza el stock del producto.
    public function updateStock(int $productoId, int $unidades): void {
        $stmt = $this->pdo->prepare("UPDATE productos SET Stock = Stock - ? WHERE CodProd = ?");
        $stmt->execute([$unidades, $productoId]);
    }
}