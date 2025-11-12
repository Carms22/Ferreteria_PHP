<?php
/**
 * Clase Categoria
 * Representa una categoría de productos en la ferretería.
 */
class Categoria{
    /**
     * Código único de la categoría
     * @var int
     */
    private int $codCat;

    /**
     * Nombre de la categoría
     * @var string
     */
    private string $nombre;

    /**
     * Descripción de la categoría
     * @var string
     */
    private string $descripcion;

    /**
     * Constructor de la clase
     * @param int $codCat Código de la categoría
     * @param string $nombre Nombre de la categoría
     * @param string $descripcion Descripción de la categoría
     */
    public function __construct(int $codCat, string $nombre, string $descripcion){
        $this->codCat = $codCat;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    /**
     * Obtiene el código de la categoría
     * @return int
     */
    public function getCodCat(): int{
        return $this->codCat;
    }

    /**
     * Establece el código de la categoría
     * @param int $codCat
     * @return void
     */
    public function setCodCat(int $codCat): void{
        $this->codCat = $codCat;
    }

    /**
     * Obtiene el nombre de la categoría
     * @return string
     */
    public function getNombre(): string{
        return $this->nombre;
    }

    /**
     * Establece el nombre de la categoría
     * @param string $nombre
     * @return void
     */
    public function setNombre(string $nombre): void{
        $this->nombre = $nombre;
    }

    /**
     * Obtiene la descripción de la categoría
     * @return string
     */
    public function getDescripcion(): string{
        return $this->descripcion;
    }

    /**
     * Establece la descripción de la categoría
     * @param string $descripcion
     * @return void
     */
    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    /**
     * Devuelve la categoría como string legible
     * @return string
     */
    public function __toString(): string{
        return $this->nombre . " - " . $this->descripcion;
    }
}
