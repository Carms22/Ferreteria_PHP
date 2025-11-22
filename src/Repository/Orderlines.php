<?php
require_once __DIR__."/../Entity/Orderline.php";

class OrderLines {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    //Inserta una línea de pedido.
    public function addOrderLine(int $pedidoId, int $productoId, int $unidades): void {
        $sql="INSERT INTO pedidosproductos (Pedido, Producto, Unidades) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1,$pedidoId);
        $stmt->bindParam(2,$productoId);
        $stmt->bindParam(3,$unidades);
        $stmt->execute();
    }

    //Actualiza el stock del producto.
    public function updateStock(int $productoId, int $unidades): void {
        $sql="UPDATE productos SET Stock = Stock - :unidades WHERE CodProd = :productoId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':productoId',$productoId);
        $stmt->bindParam(':unidades',$unidades);
        $stmt->execute();
    }

    public function getOrderlineById(int $CodPedido){
        $sql=" SELECT p.CodPed, prod.CodProd, prod.Nombre AS NombreProducto, prod.Descripcion, prod.Peso, pp.Unidades
                FROM pedidosproductos pp
                INNER JOIN productos prod ON pp.Producto = prod.CodProd
                INNER JOIN categorias c ON prod.Categoria = c.CodCat
                INNER JOIN pedidos p ON pp.Pedido = p.CodPed
                WHERE p.CodPed = :CodPedido";
        $stmt=$this->pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        }
        return null;


    }
}