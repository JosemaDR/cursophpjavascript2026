<?php
class LineaFacturaEntity {
   public function __construct(
      private ?int $id,
      private int $facturaId,
      private string $concepto,
      private int $cantidad,
      private float $precioUnitario,
      private float $subtotal
   ) {}
   // Getters correspondientes...
}