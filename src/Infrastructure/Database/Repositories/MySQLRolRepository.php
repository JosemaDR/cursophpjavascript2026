<?php
defined('APP_ROOT') or header('Location: ../index.php');

require_once APP_ROOT . '/src/Domain/Repositories/IRolRepository.php';
require_once APP_ROOT . '/src/Domain/Entities/RolEntity.php';

class MySQLRolRepository implements IRolRepository {
   private PDO $db;

   public function __construct(DatabaseConnection $dbConnection) {
      $this->db = $dbConnection->conectar();
   }

   public function findAll(): array {
      $stmt = $this->db->query("SELECT id, nombre FROM roles");
      $roles = [];

      while ($row = $stmt->fetch()) {
         $roles[] = new RolEntity($row['id'], $row['nombre']);
      }

      return $roles;
   }

   public function findById(int $id): ?RolEntity {
      $stmt = $this->db->prepare("SELECT * FROM roles WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $row = $stmt->fetch();

      return $row ? new RolEntity($row['id'], $row['nombre']) : null;
   }
}