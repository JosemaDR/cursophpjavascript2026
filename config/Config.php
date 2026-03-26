<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // Atributos, propiedades, características, son datos que describen a un objeto.
   // Métodos, funciones, acciones, son comportamientos que un objeto puede realizar.
   class Config {
      const NOMBRE_APP = 'Tienda virtual del curso de PHP';
   }

   $objConfig = new Config();
   $objConfig2 = new Config();

   var_dump(Config::NOMBRE_APP);

   // TODO: Valor de la constante: la carpeta calcularla dinámicamente.
   define('APP_FOLDER', '/CURSO/');

   define('APP_ENTORNO', '.env');

   $baseDatosConfig = Array();

   function getConfiguracion() {
      if(file_exists(APP_ENTORNO)) {
         $contenidoEnv = file_get_contents(APP_ENTORNO);
         $env = explode('=', $contenidoEnv);

         $ficheroConfiguracion = APP_ENTORNO . '.' . $env[1];
         $datosConfig = parse_ini_file($ficheroConfiguracion, true);

         $baseDatosConfig = $datosConfig['BASE DE DATOS'];
      }
   }

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

   getConfiguracion();