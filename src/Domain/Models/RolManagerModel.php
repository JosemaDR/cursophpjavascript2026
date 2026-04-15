<?php
defined('APP_ROOT') or header('Location: ../index.php');

class RolManagerModel {
   public function esRolProtegido(RolEntity $rol): bool {
      // Regla: El rol 'administrador' no se puede borrar nunca
      return strtolower($rol->getNombre()) === 'administrador';
   }
}