<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // TODO: Valor de la constante: la carpeta calcularla dinámicamente.
   define('APP_FOLDER', '/CURSO/');

   define('APP_ENTORNO', '.env');

   $baseDatosConfig = Array();
   // $dbEngine = '';
   // $bdHost   = '';
   // $bdUser   = '';
   // $bdPassword = '';
   // $bdName = '';

   function getConfiguracion() {
      if(file_exists(APP_ENTORNO)) {
         $contenidoEnv = file_get_contents(APP_ENTORNO);
         $env = explode('=', $contenidoEnv);

         // Nosotros usamos el sistema de ficheros .env.xxxx
         $ficheroConfiguracion = APP_ENTORNO . '.' . $env[1];
         $datosConfig = parse_ini_file($ficheroConfiguracion, true);

         $baseDatosConfig = $datosConfig['BASE DE DATOS'];
         // $dbEngine = $datosConfig['BASE DE DATOS']['dbEngine'];
         // $dbHost = $datosConfig['BASE DE DATOS']['dbHost'];
         // $dbUser = $datosConfig['BASE DE DATOS']['dbUser'];
         // $dbPassword = $datosConfig['BASE DE DATOS']['dbPassword'];
         // $dbName = $datosConfig['BASE DE DATOS']['dbName'];

         var_dump($baseDatosConfig);


         // Una solución de lectura de ficheros de configuración .env (ficheros de texto)
         // if(file_exists($ficheroConfiguracion) &&
         //    ($envFile = fopen($ficheroConfiguracion, 'r'))) {

         //    while(!feof($envFile)) {
         //       $linea = fgets($envFile);
         //       $linea[strlen($linea) - 1] !== "\n" ? : $linea = substr($linea, 0, -1);

         //       // Otras formas de eliminar el salto de línea:
         //       // $linea[strlen($linea) - 1] === "\n" ? $linea = substr($linea, 0, -1) : '';
         //       // if($linea[strlen($linea) - 1] === "\n"){ $linea = substr($linea, 0, -1); }

         //       if($linea[0] !== '#') {
         //          $linea = explode('=', $linea);
         //          $clave = $linea[0];
         //          $valor = $linea[1];
         //          switch($clave) {
         //             case 'dbEngine':
         //                $dbEngine = $valor;
         //                break;
         //             case 'dbHost':
         //                $dbHost = $valor;
         //                break;
         //             case 'dbUser':
         //                $dbUser = $valor;
         //                break;
         //             case 'dbPassword':
         //                $dbPassword = $valor;
         //                break;
         //             case 'dbName':
         //                $dbName = $valor;
         //                break;
         //          }
         //       }

         //    }

         //    fclose($envFile);
         // } else {
         //    throw new Exception('Que no, que necesito el fichero');
         // }

         //$envFile = fopen($ficheroConfiguracion . '-', 'r') or
         //throw new Exception("No se puede abrir el fichero de configuración requerido.");
      }
   }
         // Otra solución de lectura de ficheros .env de configuración.
         /*$contenidoEnv = file_get_contents(APP_ENTORNO);
         $env = explode('=', $contenidoEnv);
         
         // Si usamos el sistema de configuración "dinámica" con ficheros config.xxxx.php.
         // require_once APP_ROOT . '/config/config.' . $env[1] . '.php';


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
   }*/

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