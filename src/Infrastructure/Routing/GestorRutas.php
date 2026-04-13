<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Infrastructure/Routing/Listeners/_404Listener.php';

   class GestorRutas {
      private static array $rutasDisponibles;
      private static string $url;
      private static array $urlPartes;
      private static EventDispatcher $dispatcher;

      public static function init() {
         self::$rutasDisponibles = Config::getRutas();
         self::$dispatcher = new EventDispatcher();
         self::$dispatcher->suscribe('app.recurso_no_encontrado', new _404Listener());
      }

      public static function getRutaActual() {
         self::$urlPartes[0];
      }

      public static function getController() {
         /*
         $_SERVER['PATH_INFO'] ?? '': El operador null coalescing gestiona el caso de que la clave no exista
         (evitando el Notice), devolviendo una cadena vacía en su lugar.

         trim(..., '/'): Elimina las barras laterales. Si el usuario entra en / o no entra nada, el resultado
         de trim sobre una cadena vacía o una barra es una cadena vacía "".

         ?: 'root': Aquí está la magia del operador Elvis. En PHP, una cadena vacía "" se evalúa como false.
         Por lo tanto, si después del trim el resultado es nada, el operador asigna automáticamente 'root'.

         Con esta línea de abajo, evitamos los ifs y varias líneas de código adicional.
         */
         self::$url = trim($_SERVER['PATH_INFO'] ?? '', '/') ?: 'root';
         if(self::$url === 'inicio') self::$url = 'root';

         self::$urlPartes = explode('/', self::$url);
         if(array_key_exists(self::$urlPartes[0], self::$rutasDisponibles)) {
            require_once APP_ROOT . '/src/Controllers/' . ucfirst(self::$rutasDisponibles[self::$urlPartes[0]]) . 'Controller.php';
         } else {
            self::$dispatcher->dispatch('app.recurso_no_encontrado', self::$urlPartes[0]);
            exit;
         }
      }
   }