<?php
defined('APP_ROOT') or header('Location: ../index.php');

class FacturaEntity {
   public function __construct(
      private ?int $id,
      private int $pedidoId,
      private string $numeroFactura,
      private string $fechaFactura,
      private float $baseImponible,
      private float $ivaPorcentaje,
      private float $totalFactura
   ) {}

   public function getId(): ?int { return $this->id; }
   public function getNumeroFactura(): string { return $this->numeroFactura; }
   public function getTotalFactura(): float { return $this->totalFactura; }
   // ... rest of getters ...
}