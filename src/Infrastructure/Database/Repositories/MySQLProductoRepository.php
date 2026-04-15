<?php
defined('APP_ROOT') or header('Location: ../index.php');

require_once APP_ROOT . '/src/Domain/Repositories/IProductoRepository.php';
require_once APP_ROOT . '/src/Domain/Entities/ProductoEntity.php';

class MySQLProductoRepository implements IProductoRepository {
   private PDO $db;

   public function __construct(DatabaseConnection $dbConnection) {
      $this->db = $dbConnection->conectar();
   }

   public function findAll(): array {
      $stmt = $this->db->query("SELECT * FROM productos");
      $productos = [];

      while ($row = $stmt->fetch()) {
         $productos[] = new ProductoEntity(
               $row['id'],
               $row['nombre'],
               $row['descripcion'],
               $row['precio'],
               $row['imagen']
         );
      }

      return $productos;
   }

   public function findById(int $id): ?ProductoEntity {
      $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $row = $stmt->fetch();

      if (!$row) return null;

      return new ProductoEntity(
         $row['id'],
         $row['nombre'],
         $row['descripcion'],
         $row['precio'],
         $row['imagen']
      );
   }
}