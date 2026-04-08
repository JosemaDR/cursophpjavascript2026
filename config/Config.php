<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Infrastructure/Routing/Listeners/RutaNoExistenteListener.php';

   class Config {
      const NOMBRE_APP = 'Tienda virtual del curso de PHP';
      const APP_ENTORNO = '.env';

      private static $rutaAPPWeb = '';
      private static $rutas = Array();
      private static $dbData = Array();
      private static $entornoActual = 'local';
      private static $dispatcher;

      public static function init() {
         self::$dispatcher = new EventDispatcher();

         self::$dispatcher->suscribe('config.ruta.inexistente', new RutaNoExistenteListener());

         try {
            self::setRutaAPPWeb();
            self::getConfigurationData();
            self::setErrorsConfiguration();
         } catch (Exception $e) {
            echo 'Gestionando Excepción:', $e;
         } catch (Error $e) {
            echo 'Gestionando Error:', $e;
         } finally {
            empty($e) ?: error_log($e, 0, APP_ROOT . '/logs/errores.log');
            //$e ?? error_log($e, 0, APP_ROOT . '/logs/errores.log');
         }
      }

      public static function setRutaAPPWeb() {
         if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) {
            $uri = 'https://';
         } else {
            $uri = 'http://';
         }

         $uri .= $_SERVER['HTTP_HOST'];

         $scriptEjecutandoseMasCarpeta = $_SERVER['SCRIPT_NAME'];
         $soloScriptEjecutandose = basename($_SERVER['SCRIPT_NAME']);
         $folderAPP = str_replace($soloScriptEjecutandose, '', $scriptEjecutandoseMasCarpeta);

         self::$rutaAPPWeb = $uri . $folderAPP;
      }
      public static function getRutaAPPWeb() {
         return self::$rutaAPPWeb;
      }

      public static function getConfigurationData() {
         try {
            if(file_exists(self::APP_ENTORNO)) {
               $contenidoEnv = file_get_contents(self::APP_ENTORNO);
               $env = explode('=', $contenidoEnv);
               self::$entornoActual = $env[1];

               $ficheroConfiguracion = self::APP_ENTORNO . '.' . $env[1];
               $datosConfig = parse_ini_file($ficheroConfiguracion, true);

               self::$rutas = $datosConfig['ROUTING'];
               self::$dbData = $datosConfig['BASE DE DATOS'];
            } else {
               throw new NoEnvFile('No existe el fichero de configuración general del entorno');
            }
         } catch(NoEnvFile $e) {
            self::$dispatcher->dispatch('config.ruta.inexistente', $e);
         } catch(Exception $e) {
            echo $e->getMessage();
         } catch(Error $e) {
            echo $e->getMessage();
         }
      }

      public static function getRutas() {
         return self::$rutas;
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
               ini_set('log_errors', 1);
               ini_set('error_log', APP_ROOT . '/logs/errores.log');
               break;
            case 'prod':
               error_reporting(E_ALL);
               ini_set('display_errors', 0);
               ini_set('log_errors', 1);
               ini_set('error_log', APP_ROOT . '/logs/errores.log');
               break;
         }
      }
   }