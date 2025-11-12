<?php
/**
 * Clase Ferreteria
 * Representa una ferretería registrada en el sistema.
 */
class User{
    private int $codRes;
    private string $nombre;
    private string $correo;
    private string $clave;
    private string $pais;
    private ?int $cp;       // puede ser NULL
    private string $ciudad;
    private string $direccion;
    private int $rol;

    public function __construct(int $codRes, string $nombre, string $correo, string $clave, string $pais, ?int $cp, string $ciudad, string $direccion, int $rol)
    {
        $this->codRes = $codRes;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->pais = $pais;
        $this->cp = $cp;
        $this->ciudad = $ciudad;
        $this->direccion = $direccion;
        $this->rol = $rol;
    }

    public function getCodRes(): int { return $this->codRes; }
    public function setCodRes(int $codRes): void { $this->codRes = $codRes; }

    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }

    public function getCorreo(): string { return $this->correo; }
    public function setCorreo(string $correo): void { $this->correo = $correo; }

    public function getClave(): string { return $this->clave; }
    public function setClave(string $clave): void { $this->clave = $clave; }

    public function getPais(): string { return $this->pais; }
    public function setPais(string $pais): void { $this->pais = $pais; }

    public function getCp(): ?int { return $this->cp; }
    public function setCp(?int $cp): void { $this->cp = $cp; }

    public function getCiudad(): string { return $this->ciudad; }
    public function setCiudad(string $ciudad): void { $this->ciudad = $ciudad; }

    public function getDireccion(): string { return $this->direccion; }
    public function setDireccion(string $direccion): void { $this->direccion = $direccion; }

    public function getRol(): int { return $this->rol; }
    public function setRol(int $rol): void { $this->rol = $rol; }
}
