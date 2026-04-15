<?php
defined('APP_ROOT') or header('Location: ../index.php');

class LoginService {
   private static bool $logado = false;

   /**
    * Se ejecuta en el bootstrap para sincronizar el estado del servicio con la $_SESSION
    */
   public static function init(): void {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }
      
      if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
         self::$logado = true;
      }
   }

   /**
    * Registra al usuario en la sesión global
    */
   public static function doLogin(UsuarioEntity $usuario): void {
      $_SESSION['logado'] = true;
      $_SESSION['user_id'] = $usuario->getId();
      $_SESSION['user_nombre'] = $usuario->getUsuario();
      $_SESSION['user_rol'] = $usuario->getRoleId();
      
      self::$logado = true;
   }

   /**
    * Cierra la sesión y limpia el servicio
    */
   public static function logout(): void {
      session_unset();
      session_destroy();
      self::$logado = false;
   }

   /**
    * Retorna si el usuario actual está autenticado
    */
   public static function isLogged(): bool {
      return self::$logado;
   }

   /**
    * Retorna el ID del rol del usuario logado (para control de accesos)
    */
   public static function getRol(): ?int {
      return $_SESSION['user_rol'] ?? null;
   }
}