<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // TODO: Valor de la constante: la carpeta calcularla dinámicamente.
   define('APP_FOLDER', '/CURSO/');

   define('APP_ENTORNO', '.env');

   $dbEngine = '';
   $bdHost   = '';
   $bdUser   = '';
   $bdPassword = '';
   $bdName = '';

   function getConfiguracion() {
      if(file_exists(APP_ENTORNO)) {
         $contenidoEnv = file_get_contents(APP_ENTORNO);
         $env = explode('=', $contenidoEnv);
         
         // Si usamos el sistema de configuración "dinámica" con ficheros config.xxxx.php.
         // require_once APP_ROOT . '/config/config.' . $env[1] . '.php';

         // Nosotros usamos el sistema de ficheros .env.xxxx
         $ficheroConfiguracion = APP_ENTORNO . '.' . $env[1];
         if(file_exists($ficheroConfiguracion)) {
            $contenido = file_get_contents($ficheroConfiguracion);
            $contenido = explode("\n", $contenido);

            foreach($contenido as  $elemento) {
               // La función substr() permite extraer una porción de una cadena (devuelve esa porción
               // como cadena).
               // if(substr($elemento, 0, 1) === '#') {
               if($elemento[0] !== '#') {
                  $parClaveValor = explode('=', $elemento);
                  $clave = $parClaveValor[0];
                  $valor = $parClaveValor[1];
                  switch($clave) {
                     case 'dbEngine':
                        $dbEngine = $valor;
                        break;
                     case 'dbHost':
                        $dbHost = $valor;
                        break;
                     case 'dbUser':
                        $dbUser = $valor;
                        break;
                     case 'dbPassword':
                        $dbPassword = $valor;
                        break;
                     case 'dbName':
                        $dbName = $valor;
                        break;
                  }
               }
            }
         }
      } else {
         throw new Exception('Falta el fichero de inicialización de la configuración');
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