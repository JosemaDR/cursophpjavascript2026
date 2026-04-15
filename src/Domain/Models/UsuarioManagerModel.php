<?php
defined('APP_ROOT') or header('Location: ../index.php');

class UsuarioManagerModel {
   public function validarPasswordSegura(string $password): bool {
      // Regla: Mínimo 8 caracteres (puedes añadir más reglas luego)
      return strlen($password) >= 8;
   }

   public function formatearNombrePublico(UsuarioEntity $usuario): string {
      return "@" . strtolower($usuario->getUsuario());
   }
}