<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class ErrorManager {
      public static function register() {
         set_error_handler(function($errno, $errstr, $errfile, $errline) {
            // Números de los posibles errores "legacy":
            // E_RECOVERABLE_ERROR  4096
            // E_USER_NOTICE        1024
            // E_USER_WARNING        512
            // E_USER_ERROR          256
            // E_COMPILE_WARNING     128
            // E_COMPILE_ERROR        64
            // E_CORE_WARNING         32
            // E_CORE_ERROR           16
            // E_PARSE                 4
            // E_WARNING               2
            // E_ERROR                 1
         
            throw new ErrorException('Error legacy nº: ' . $errno);
         });
      }
   }