<?php
defined('APP_ROOT') or header('Location: ../index.php');

class DatabaseConnection {
   private string $urlConexion;
   private ?PDO $conexion = null; // Aquí guardaremos la conexión real

   public function __construct() {
      $this->setUrlConexion();
   }

   private function setUrlConexion(): void {
      $this->urlConexion = sprintf(
         '%s:host=%s;dbname=%s;charset=utf8mb4',
         Config::getDBEngine(),
         Config::getDBHost(),
         Config::getDBName()
      );
   }

   public function conectar(): ?PDO {
      // Si ya estamos conectados, devolvemos la conexión existente (Singleton básico)
      if ($this->conexion !== null) {
         return $this->conexion;
      }

      try {
         $this->conexion = new PDO(
               $this->urlConexion, 
               Config::getDBUser(), 
               Config::getDBPassword(),
               [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATE_PREPARES => false,
               ]
         );
         return $this->conexion;
      } catch(PDOException $e) {
         // En lugar de echo, lanzamos una excepción de las que tienes en Domain o Infrastructure
         throw new Exception("Error de conexión a la base de datos: " . $e->getMessage());
      }
   }
}