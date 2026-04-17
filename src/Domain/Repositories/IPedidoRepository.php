<?php
interface IPedidoRepository {
   public function findById(int $id): ?PedidoEntity;
   public function findByUsuario(int $usuarioId): array;
   public function save(PedidoEntity $pedido): int; // Devuelve el ID generado
   public function updateEstado(int $pedidoId, string $nuevoEstado): bool;
}