<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // TODO: Valor de la constante: la carpeta calcularla dinámicamente.
   define('APP_FOLDER', '/CURSO/');

   function getRutaWebApp() {
      if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
         $uri = 'https://';
      } else {
         $uri = 'http://';
      }

      $uri .= $_SERVER['HTTP_HOST'];

      return $uri . APP_FOLDER;
   }

   $config = [
      'nombreAPP' => 'Tienda virtual del curso de PHP',
      'rutaAPPWeb' => getRutaWebApp(),
      'dev' => [],
      'prod' => []
   ];