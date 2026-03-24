<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // Usamos la función array para crear el array, valga la redundancia, en lugar de [...],
   // para recordar que también lo podemos hacer así. Los corchetes son más eficientes.
   $rutasDisponibles = Array(
      '/' => 'inicio',
      'inicio' => 'inicio',
      'catalogo' => 'catalogo',
      'producto' => 'producto',
      'contactar' => 'contactar',    
   );

   $url = '';
   $urlPartes = [];

   if(empty($_SERVER['PATH_INFO'])) {
      require_once APP_ROOT . '/vistas/inicio.php';
   } else {
      $url = $_SERVER['PATH_INFO'];
      ($url == '/') ? : $url = trim($url, '/');

      $urlPartes = explode('/', $url);

      if(array_key_exists($urlPartes[0], $rutasDisponibles)) {
         require_once APP_ROOT . '/src/Controllers/' . ucfirst($rutasDisponibles[$urlPartes[0]]) . 'Controller.php';
      } else {
         http_response_code(404);
         header('Content-Type: text/html; charset=utf-8');
         require_once APP_ROOT . '/vistas/404.php';

         exit;
      }
   }