<?php
class MySQLPedidoRepository implements IPedidoRepository {
   private PDO $db;

   public function __construct(DatabaseConnection $dbConnection) {
      $this->db = $dbConnection->conectar();
   }

   public function save(PedidoEntity $pedido): int {
      try {
         $this->db->beginTransaction();

         $stmt = $this->db->prepare("INSERT INTO pedidos (usuario_id, total, estado) VALUES (?, ?, ?)");
         $stmt->execute([
               $pedido->getUsuarioId(),
               $pedido->getTotal(),
               $pedido->getEstado()
         ]);
         
         $pedidoId = (int)$this->db->lastInsertId();

         $stmtL = $this->db->prepare("INSERT INTO lineas_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
         foreach ($pedido->getLineas() as $linea) {
               $stmtL->execute([
                  $pedidoId,
                  $linea->getProductoId(),
                  $linea->getCantidad(),
                  $linea->getPrecioUnitario()
               ]);
         }

         $this->db->commit();
         return $pedidoId;
      } catch (Exception $e) {
         $this->db->rollBack();
         return 0;
      }
}

         $this->db->commit();
         return $pedidoId;
      } catch (Exception $e) {
         $this->db->rollBack();
         throw $e;
      }
   }

   public function findByUsuario(int $usuarioId): array {
      $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY fecha DESC");
      $stmt->execute([$usuarioId]);
      // Mapeo a entidades...
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}