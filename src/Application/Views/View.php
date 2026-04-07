<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class View {
      public static function render(string $path, array $data = []) {
         // Convertimos el array en variables individuales (ej: ['nombre' => 'Juan'] -> $nombre)
         extract($data);

         // Definimos la ruta física al archivo de la vista
         $file = APP_ROOT . '/vistas/' . $path . '.php';

         if (file_exists($file)) {
            require_once $file;
         } else {
            // Si la vista no existe, lanzamos un error que capturará nuestro ErrorManager
            throw new Exception("La vista [{$path}] no se encuentra en " . $file);
         }
      }
   }