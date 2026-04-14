<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class ErrorManager {
      private static $dispatcher;

      public static function register() {
         self::$dispatcher = new EventDispatcher();

         set_error_handler(function($level, $message, $file, $line) {
            if(!(error_reporting() & $level)) return;

            throw new ErrorException($message, 0, $level, $file, $line);
         });

         set_exception_handler([self::class, 'handleException']);
      }

      public static function handleException (Throwable $e) {
         self::renderResponse($e);
         exit;
      }

      public static function renderResponse(Throwable $e) {
         if(ini_get('display_errors')) {
            echo '<h2>Error detectado:</h2>';
            echo '<p><strong>Mensaje: </strong>', $e->getMessage() , '</p>';
            echo '<pre>', $e->getTraceAsString(), '</pre>';
         } else {
            http_response_code(500);
            require_once APP_ROOT . '/public/public/errores/500.php';
         }
      }
   }