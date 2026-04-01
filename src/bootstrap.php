<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Core/Exceptions.php';
   require_once APP_ROOT . '/src/Core/ErrorManager.php';
   require_once APP_ROOT . '/config/Config.php';
   require_once APP_ROOT . '/src/Core/PDO.php';
   require_once APP_ROOT . '/src/Controllers/GestorRutas.php';
   
   ErrorManager::register();
   Config::init();

   $conn = new PDOAPP();
   $conn->conectar();

   // Alternativa tradicional al try-catch (que tiene prioridad) para capturar cualquier error
   // de tipo Exception (Exception y Error).
   // set_exception_handler(function($exception){
   //    echo 'Error crítico: ', $exception->getMessage();
   // });