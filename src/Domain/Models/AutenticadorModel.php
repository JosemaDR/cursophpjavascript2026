<?php
defined('APP_ROOT') or header('Location: ../index.php');

class AutenticadorModel {
   private IUsuarioRepository $usuarioRepo;

   public function __construct(IUsuarioRepository $usuarioRepo) {
      $this->usuarioRepo = $usuarioRepo;
   }

   public function validarAcceso(string $username, string $password): ?UsuarioEntity {
      $usuario = $this->usuarioRepo->findByUsername($username);

      if (!$usuario) {
         return null; // El usuario no existe
      }

      // Aquí aplicamos la regla de negocio: ¿Coincide la clave?
      // En la 2ª edición usarás password_verify($password, $usuario->getClave())
      if ($password === $usuario->getClave()) {
         return $usuario;
      }

      return null; // Clave incorrecta
   }

   public function esAdmin(UsuarioEntity $usuario): bool {
      // Regla: El ID del rol administrador es 1 (según nuestro script.sql)
      return $usuario->getRoleId() === 1;
   }
}