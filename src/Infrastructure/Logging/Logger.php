<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class Logger {
      private static $logPath = APP_ROOT . '/logs';

      // Estándar PHP PSR-3:https://www.php-fig.org/psr/psr-3/
      /*
         1.- Emergency: sistema inutilizable.
         2.- Alert: requieren acción inmediata (se ha caído la web).
         3.- Critical: condiciones críticas (base de datos "muerta" por ejemplo).
         4.- Error: errores de ejecución pero que no requieren acción inmediata.
         5.- Warning: advertencias (fallos que no detendrán la app).
         6.- Notice: eventos "normales" pero significativo.
         7.- Info: mensajes informativos (usuario que se ha logado).
         8.- Debug: información detallada para depuración.
      */

      public static function alert($message) {
         self::write('ALERT', $message);
      }
      public static function critical($message) {
         self::write('CRITICAL', $message);
      }
      public static function error($message) {
         self::write('ERROR', $message);
      }
      public static function warning($message) {
         self::write('WARNING', $message);
      }
      public static function notice($message) {
         self::write('NOTICE', $message);
      }
      public static function info($message) {
         self::write('INFO', $message);
      }
      public static function debug($message) {
         self::write('DEBUG', $message);
      }

      public static function write($level, $message, $context = []) {
         $date = date('Y-m-d H:i:s');
         $contexto = !empty($context) ? json_encode($context) : '';
         $line = "[$date][$level]: $message $contexto" . PHP_EOL;

         // TODO: try-catch, gestión de posibles errores y eventos.
         file_put_contents(self::$logPath, $line, FILE_APPEND);
      }
   }