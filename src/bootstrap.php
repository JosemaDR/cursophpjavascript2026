<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Application/Events/ListenerInterface.php';
   require_once APP_ROOT . '/src/Application/Events/EventDispatcher.php';
   require_once APP_ROOT . '/src/Domain/Exceptions.php';
   require_once APP_ROOT . '/src/Application/ErrorManager.php';
   require_once APP_ROOT . '/config/Config.php';
   require_once APP_ROOT . '/src/Infrastructure/PDO.php';
   require_once APP_ROOT . '/src/Controllers/GestorRutas.php';

   // TODO: Estas líneas son de ejemplo de la clase de hoy:
   require_once APP_ROOT . '/Exceptions/Errores/ErrorLogListener.php';
   require_once APP_ROOT . '/Exceptions/Errores/AdminAlertListener.php';
   
   $dispatcher = new EventDispatcher();

   $dispatcher->suscribe('app_error', new ErrorLogListener());
   $dispatcher->suscribe('app_error', new AdminAlertListener());

   ErrorManager::register($dispatcher);

   Config::init();

   $conn = new PDOAPP();
   $conn->conectar();

   // ORDEN DE PRIORIDADES DE GESTIÓN DE ERRORES:
   // 1.- TRY-CATCH. El error muere aqui y el sistema global no se entera a menos que hagamos un nuevo throw.

   // 2.- SET_ERROR_HANDLER(). Sin forma diferente actual de gestionar errores "legacy", lo "traducimos" a un
   // ErrorException. Al hacerlo, vuelve a buscar un try-catch o lo que fuera.

   // 3.- SET_EXCEPTION_HANDLER(). Último recurso, si nadie ha podido capturar nada.

   // ERRORES CAPTURABLES:
   // Excepciones, Excepciones como errores,
   // Errores recuperables (warnings, notice, deprecated -> set_error_handler()), otros Errores fatales desde la
   // versión de PHP 7+.

   // ERRORES NO RECUPERABLES:
   // Parse Error, Out of Memory, errores provocados en el servidor.