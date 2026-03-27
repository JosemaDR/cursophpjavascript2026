<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // Atributos, propiedades, características, son datos que describen a un objeto.
   // Métodos, funciones, acciones, son comportamientos que un objeto puede realizar.
   class Config {
      const NOMBRE_APP = 'Tienda virtual del curso de PHP';
      const APP_ENTORNO = '.env';

      // El principio de la POO de Encapsulación indica que todos sus atributos o propiedades deben ser
      // privados.
      private static $rutaAPPWeb = '';
      private static $dbData = Array();
      private static $entornoActual = 'local';

      public static function init() {
         self::setRutaAPPWeb();
         self::getConfigurationData();
      }

      public static function setRutaAPPWeb() {
         if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
            $uri = 'https://';
         } else {
            $uri = 'http://';
         }

         $uri .= $_SERVER['HTTP_HOST'];

         // $_SERVER['PHP_SELF'] ---> Ofrece el mismo dato que $_SERVER['SCRIPT_NAME'].
         $scriptEjecutandoseMasCarpeta = $_SERVER['SCRIPT_NAME'];
         $soloScriptEjecutandose = basename($_SERVER['SCRIPT_NAME']);
         $folderAPP = str_replace($soloScriptEjecutandose, '', $scriptEjecutandoseMasCarpeta);

         self::$rutaAPPWeb = $uri . $folderAPP;
      }
      public static function getRutaAPPWeb() {
         return self::$rutaAPPWeb;
      }

      public static function getConfigurationData() {
         if(file_exists(self::APP_ENTORNO)) {
            $contenidoEnv = file_get_contents(self::APP_ENTORNO);
            $env = explode('=', $contenidoEnv);
            self::$entornoActual = $env[1];

            $ficheroConfiguracion = self::APP_ENTORNO . '.' . $env[1];
            $datosConfig = parse_ini_file($ficheroConfiguracion, true);

            self::$dbData = $datosConfig['BASE DE DATOS'];
         }
      }

      public static function getDatabaseConfiguration() {
         return self::$dbData;
      }
      public static function getDBEngine() {
         return self::$dbData['dbEngine'];
      }
      public static function getDBHost() {
         return self::$dbData['dbHost'];
      }
      public static function getDBUser() {
         return self::$dbData['dbUser'];
      }
      public static function getDBPassword() {
         return self::$dbData['dbPassword'];
      }
      public static function getDBName() {
         return self::$dbData['dbName'];
      }

      public static function setErrorsConfiguration() {
         switch(self::$entornoActual) {
            case 'local':
            case 'dev':
            case 'pre':
               error_reporting(E_ALL);
               ini_set('display_errors', 1);
               ini_set('display_startup_errors', 1);
               break;
            case 'prod':
               error_reporting(E_ALL);
               ini_set('display_errors', 0);
               ini_set('log_errors', 1);
               break;
         }
      }
   }