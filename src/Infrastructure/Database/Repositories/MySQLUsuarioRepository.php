<?php
defined('APP_ROOT') or header('Location: ../index.php');

require_once APP_ROOT . '/src/Domain/Repositories/IUsuarioRepository.php';
require_once APP_ROOT . '/src/Domain/Entities/UsuarioEntity.php';

class MySQLUsuarioRepository implements IUsuarioRepository {
   private PDO $db;

   public function __construct(DatabaseConnection $dbConnection) {
      $this->db = $dbConnection->conectar();
   }

   public function findByUsername(string $username): ?UsuarioEntity {
      $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = :user");
      $stmt->execute(['user' => $username]);
      $row = $stmt->fetch();

      if (!$row) return null;

      return new UsuarioEntity(
         $row['id'],
         $row['usuario'],
         $row['clave'],
         $row['role_id']
      );
   }

   public function findById(int $id): ?UsuarioEntity {
      $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $row = $stmt->fetch();

      return $row ? new UsuarioEntity($row['id'], $row['usuario'], $row['clave'], $row['rol_id']) : null;
   }

   public function save(UsuarioEntity $usuario): bool {
      $stmt = $this->db->prepare(
         "INSERT INTO usuarios (usuario, clave, role_id) VALUES (:u, :c, :r)"
      );
      return $stmt->execute([
         'u' => $usuario->getUsuario(),
         'c' => $usuario->getClave(),
         'r' => $usuario->getRoleId()
      ]);
   }
}