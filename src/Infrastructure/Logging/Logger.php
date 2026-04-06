<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class Logger {
      private static $logPath = APP_ROOT . '/logs';

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

         file_put_contents(self::$logPath, $line, FILE_APPEND);
      }
   }