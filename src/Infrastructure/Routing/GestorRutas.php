<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Infrastructure/Routing/Listeners/_404Listener.php';

   class GestorRutas {
      private static array $rutasDisponibles;
      private static string $url;
      private static array $urlPartes;
      private static EventDispatcher $dispatcher;
      private static $controller;

      public static function init() {
         self::$rutasDisponibles = Config::getRutas();
         self::$dispatcher = new EventDispatcher();
         self::$dispatcher->suscribe('app.recurso_no_encontrado', new _404Listener());
      }

      public static function getRutaActual(): string {
         return self::$urlPartes[0];
      }

      public static function getAccionActual(): string {
         $accion = '';
         return self::$urlPartes[1] ?? '';
      }

      public static function getController() {
         $controladorTmp = '';

         self::$url = trim($_SERVER['PATH_INFO'] ?? '', '/') ?: 'root';
         if(self::$url === 'inicio') self::$url = 'root';

         self::$urlPartes = explode('/', self::$url);

         if(array_key_exists(self::$urlPartes[0], self::$rutasDisponibles)) {
            $nombreBase = ucfirst(self::$rutasDisponibles[self::$urlPartes[0]]);
            $fichero = $nombreBase . 'Controller.php';
            $clase = $nombreBase . 'Controller';

            require_once APP_ROOT . '/src/Infrastructure/Http/Controllers/' . $fichero;
            self::$controller = new $clase();
         } else {
            self::$dispatcher->dispatch('app.recurso_no_encontrado', self::$urlPartes[0]);
            exit;
         }
      }
   }