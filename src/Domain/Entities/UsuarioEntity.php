<?php
defined('APP_ROOT') or header('Location: ../index.php');

class UsuarioEntity {
   private ?int $id;
   private string $usuario;
   private string $clave;
   private int $roleId;

   public function __construct(?int $id, string $usuario, string $clave, int $roleId) {
      $this->id = $id;
      $this->usuario = $usuario;
      $this->clave = $clave;
      $this->roleId = $roleId;
   }

   // Getters
   public function getId(): ?int { return $this->id; }
   public function getUsuario(): string { return $this->usuario; }
   public function getClave(): string { return $this->clave; }
   public function getRoleId(): int { return $this->roleId; }

   // Setters (útiles para actualizar el perfil)
   public function setUsuario(string $usuario): void { $this->usuario = $usuario; }
   public function setClave(string $clave): void { $this->clave = $clave; }
   public function setRoleId(int $roleId): void { $this->roleId = $roleId; }
}