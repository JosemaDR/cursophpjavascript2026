<?php
defined('APP_ROOT') or header('Location: ../index.php');

class MySQLFacturaRepository implements IFacturaRepository {
   private PDO $db;

   public function __construct(DatabaseConnection $dbConnection) {
      $this->db = $dbConnection->conectar();
   }

   public function save(FacturaEntity $factura, array $lineas): bool {
      try {
         $this->db->beginTransaction();

         // Insertar Cabecera
         $sqlF = "INSERT INTO facturas (pedido_id, numero_factura, base_imponible, iva_porcentaje, total_factura) 
                  VALUES (:p, :n, :b, :i, :t)";
         $stmtF = $this->db->prepare($sqlF);
         $stmtF->execute([
               'p' => $factura->getPedidoId(),
               'n' => $factura->getNumeroFactura(),
               'b' => $factura->getBaseImponible(),
               'i' => $factura->getIvaPorcentaje(),
               't' => $factura->getTotalFactura()
         ]);

         $facturaId = $this->db->lastInsertId();

         // Insertar Líneas
         $sqlL = "INSERT INTO lineas_factura (factura_id, concepto, cantidad, precio_unitario, subtotal) 
                  VALUES (:f, :c, :cant, :pre, :sub)";
         $stmtL = $this->db->prepare($sqlL);

         foreach ($lineas as $linea) {
               $stmtL->execute([
                  'f'    => $facturaId,
                  'c'    => $linea->getConcepto(),
                  'cant' => $linea->getCantidad(),
                  'pre'  => $linea->getPrecioUnitario(),
                  'sub'  => $linea->getSubtotal()
               ]);
         }

         return $this->db->commit();
      } catch (Exception $e) {
         $this->db->rollBack();
         return false;
      }
   }

   public function getSiguienteNumeroFactura(): string {
      $anioActual = date('Y');
      $stmt = $this->db->prepare("SELECT COUNT(id) as total FROM facturas WHERE YEAR(fecha_factura) = :anio");
      $stmt->execute(['anio' => $anioActual]);
      $row = $stmt->fetch();
      
      $siguiente = $row['total'] + 1;
      // Formato: FAC-2026-0001
      return "FAC-" . $anioActual . "-" . str_pad($siguiente, 4, '0', STR_PAD_LEFT);
   }

   public function findByPedidoId(int $pedidoId): ?FacturaEntity {
      $stmt = $this->db->prepare("SELECT * FROM facturas WHERE pedido_id = :id");
      $stmt->execute(['id' => $pedidoId]);
      $row = $stmt->fetch();

      if (!$row) return null;

      return new FacturaEntity(
         $row['id'], $row['pedido_id'], $row['numero_factura'], 
         $row['fecha_factura'], (float)$row['base_imponible'], 
         (float)$row['iva_porcentaje'], (float)$row['total_factura']
      );
   }
}