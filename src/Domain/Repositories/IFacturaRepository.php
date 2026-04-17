<?php
interface IFacturaRepository {
   public function findByPedidoId(int $pedidoId): ?FacturaEntity;
   public function save(FacturaEntity $factura): bool;
   public function getSiguienteNumeroFactura(): string;
}