<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Application/Events/ListenerInterface.php';
   require_once APP_ROOT . '/src/Application/Events/EventDispatcher.php';
   require_once APP_ROOT . '/src/Domain/Exceptions.php';
   require_once APP_ROOT . '/src/Infrastructure/Logging/Logger.php';
   require_once APP_ROOT . '/src/Application/ErrorManager.php';
   require_once APP_ROOT . '/config/Config.php';
   require_once APP_ROOT . '/src/Infrastructure/Database/PDO.php';
   require_once APP_ROOT . '/src/Infrastructure/Routing/GestorRutas.php';

   ErrorManager::register();

   Config::init();

   GestorRutas::init();
   GestorRutas::getController();

   // $conn = new PDOAPP();
   // $conn->conectar();