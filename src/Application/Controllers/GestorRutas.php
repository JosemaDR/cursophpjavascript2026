<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class GestorRutas {
      private static array $rutasDisponibles = Array(
         '' => 'inicio',
         '/' => 'inicio',
         'inicio' => 'inicio',
         'catalogo' => 'catalogo',
         'producto' => 'producto',
         'contactar' => 'contactar',   
      );

      private static string $url;
      private static array $urlPartes;

      public static function cargarVista() {
         if(empty($_SERVER['PATH_INFO'])) {
            require_once APP_ROOT . '/vistas/inicio.php';
         } else {
            self::$url = $_SERVER['PATH_INFO'];
            (self::$url == '/') ? : self::$url = trim(self::$url, '/');

            self::$urlPartes = explode('/', self::$url);
            if(array_key_exists(self::$urlPartes[0], self::$rutasDisponibles)) {
               require_once APP_ROOT . '/src/Controllers/' . ucfirst(self::$rutasDisponibles[self::$urlPartes[0]]) . 'Controller.php';
            } else {
               http_response_code(404);
               header('Content-Type: text/html; charset=utf-8');
               require_once APP_ROOT . '/vistas/errores/404.php';

               exit;
            }
         }
      }
   }