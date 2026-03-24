<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // Usamos la función array para crear el array, valga la redundancia, en lugar de [...],
   // para recordar que también lo podemos hacer así. Los corchetes son más eficientes.
   $rutasDisponibles = Array(
      '/' => 'inicio',
      '/inicio' =>  'inicio',
      '/contactar' =>  'contactar',      
   );

   $url = '';

   if(empty($_SERVER['PATH_INFO'])) {
      require_once APP_ROOT . '/vistas/inicio.php';
   } else {
      $url = $_SERVER['PATH_INFO'];

      if(array_key_exists($url, $rutasDisponibles)) {
         if($url == 'inicio'){
            require_once '...';
         } else if($url == 'contactar') {
            require_once '...';
         } else if ($url == 'listarcatalogo') {
            require_once '...';
         } else {

         }


         //require_once APP_ROOT . '/vistas/' . $rutasDisponibles[$url] . '.php';
      } else {
         http_response_code(404);
         header('Content-Type: text/html; charset=utf-8');
         require_once APP_ROOT . '/vistas/404.php';

         exit;
      }
   }