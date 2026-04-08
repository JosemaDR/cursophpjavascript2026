<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class _404Listener implements ListenerInterface {
      public function handle($data) {
         http_response_code(404);
         header('Content-Type: text/html; charset=utf-8');
         require_once APP_ROOT . '/vistas/errores/404.php';
      }
   }