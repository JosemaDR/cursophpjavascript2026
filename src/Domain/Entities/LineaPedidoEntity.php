<?php
class LineaPedidoEntity {
   public function __construct(
      private ?int $id,
      private int $pedidoId,
      private int $productoId,
      private int $cantidad,
      private float $precioUnitario,
      private ?string $nombreProducto = null // Opcional, para mostrar en vistas
   ) {}

   public function getProductoId(): int { return $this->productoId; }
   public function getCantidad(): int { return $this->cantidad; }
   public function getPrecioUnitario(): float { return $this->precioUnitario; }
}