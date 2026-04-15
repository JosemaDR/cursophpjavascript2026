<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class View {
      const ADMIN_VIEWS_PATH = APP_ROOT . '/public/templates/adminTemplates/';
      const PUBLIC_VIEWS_PATH = APP_ROOT . '/public/templates/publicTemplates/';

      public static function setHeaders(): void {
         require_once self::PUBLIC_VIEWS_PATH . 'head.generico.php';
         require_once self::PUBLIC_VIEWS_PATH . 'header.generico.php';
      }

      public static function setFooter(): void {
         require_once self::PUBLIC_VIEWS_PATH . 'footer.generico.php';
      }

      public static function render(string $accion, bool $admin = false, array $data = []) {
         $vista = $data['vista'];
         $accion === '' ?: ($accion = '.' . $accion);

         // Definimos la ruta física al archivo de la vista
         if($admin) {
            $file = self::ADMIN_VIEWS_PATH . $vista . $accion . '.php';
         } else {
            $file = self::PUBLIC_VIEWS_PATH . $vista . $accion  . '.php';
            self::setHeaders();
         }

         if (file_exists($file)) {
            require_once $file;
            self::setFooter();
         } else {
            // Si la vista no existe, lanzamos un error que capturará nuestro ErrorManager
            throw new Exception('La vista [' .$vista . '] no se encuentra en ' . $file);
         }
      }
   }