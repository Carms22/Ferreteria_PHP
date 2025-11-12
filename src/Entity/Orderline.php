<?php
/**
 * Clase PedidoProducto
 * Relaciona un pedido con los productos solicitados.
 */
class PedidoProducto
{
    private int $codPedProd;
    private int $pedido;   // FK a Pedido
    private int $producto; // FK a Producto
    private int $unidades;

    public function __construct(int $codPedProd, int $pedido, int $producto, int $unidades) {
        $this->codPedProd = $codPedProd;
        $this->pedido = $pedido;
        $this->producto = $producto;
        $this->unidades = $unidades;
    }

    public function getCodPedProd(): int { return $this->codPedProd; }
    public function setCodPedProd(int $codPedProd): void { $this->codPedProd = $codPedProd; }

    public function getPedido(): int { return $this->pedido; }
    public function setPedido(int $pedido): void { $this->pedido = $pedido; }

    public function getProducto(): int { return $this->producto; }
    public function setProducto(int $producto): void { $this->producto = $producto; }

    public function getUnidades(): int { return $this->unidades; }
    public function setUnidades(int $unidades): void { $this->unidades = $unidades; }
}
