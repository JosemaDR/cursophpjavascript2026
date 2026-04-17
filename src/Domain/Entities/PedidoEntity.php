<?php
defined('APP_ROOT') or header('Location: ../index.php');

class PedidoEntity {
   public function __construct(
      private ?int $id,
      private int $usuarioId,
      private string $fecha,
      private string $estado,
      private float $total,
      private array $lineas = [] // Array de objetos LineaPedidoEntity
   ) {}

   public function getId(): ?int { return $this->id; }
   public function getUsuarioId(): int { return $this->usuarioId; }
   public function getFecha(): string { return $this->fecha; }
   public function getEstado(): string { return $this->estado; }
   public function getTotal(): float { return $this->total; }
   public function getLineas(): array { return $this->lineas; }
}