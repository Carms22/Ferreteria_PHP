<?php
/**
 * Clase Product
 * Representa un producto dentro de la ferretería.
 */
class Product{
    private int $codProd;
    private string $nombre;
    private string $descripcion;
    private float $peso;
    private int $stock;
    private int $categoria; // FK a Categoria

    public function __construct(int $codProd, string $nombre, string $descripcion, float $peso, int $stock, int $categoria)
    {
        $this->codProd = $codProd;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->peso = $peso;
        $this->stock = $stock;
        $this->categoria = $categoria;
    }

    public function getCodProd(): int { return $this->codProd; }
    public function setCodProd(int $codProd): void { $this->codProd = $codProd; }

    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }

    public function getDescripcion(): string { return $this->descripcion; }
    public function setDescripcion(string $descripcion): void { $this->descripcion = $descripcion; }

    public function getPeso(): float { return $this->peso; }
    public function setPeso(float $peso): void { $this->peso = $peso; }

    public function getStock(): int { return $this->stock; }
    public function setStock(int $stock): void { $this->stock = $stock; }

    public function getCategoria(): int { return $this->categoria; }
    public function setCategoria(int $categoria): void { $this->categoria = $categoria; }
}
