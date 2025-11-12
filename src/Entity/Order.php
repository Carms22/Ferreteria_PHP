<?php
/**
 * Clase Pedido
 * Representa un pedido realizado por una ferretería.
 */
class Order{
    private int $codPed;
    private string $fecha;   // datetime como string
    private int $enviado;    // 0 o 1
    private int $ferreteria; // FK a Ferreteria

    public function __construct(int $codPed, string $fecha, int $enviado, int $ferreteria) {
        $this->codPed = $codPed;
        $this->fecha = $fecha;
        $this->enviado = $enviado;
        $this->ferreteria = $ferreteria;
    }

    public function getCodPed(): int { return $this->codPed; }
    public function setCodPed(int $codPed): void { $this->codPed = $codPed; }

    public function getFecha(): string { return $this->fecha; }
    public function setFecha(string $fecha): void { $this->fecha = $fecha; }

    public function getEnviado(): int { return $this->enviado; }
    public function setEnviado(int $enviado): void { $this->enviado = $enviado; }

    public function getFerreteria(): int { return $this->ferreteria; }
    public function setFerreteria(int $ferreteria): void { $this->ferreteria = $ferreteria; }
}
