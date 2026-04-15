<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   session_start();

   require_once APP_ROOT . '/src/Application/Events/ListenerInterface.php';
   require_once APP_ROOT . '/src/Application/Events/EventDispatcher.php';
   require_once APP_ROOT . '/src/Domain/Exceptions.php';
   require_once APP_ROOT . '/src/Infrastructure/Logging/Logger.php';
   require_once APP_ROOT . '/src/Infrastructure/Errors/ErrorManager.php';
   require_once APP_ROOT . '/config/Config.php';
   require_once APP_ROOT . '/src/Infrastructure/Database/PDO/DatabaseConnection.php';
   require_once APP_ROOT . '/src/Domain/Repositories/IUsuarioRepository.php';
   require_once APP_ROOT . '/src/Domain/Repositories/IRolRepository.php';
   require_once APP_ROOT . '/src/Domain/Entities/UsuarioEntity.php';
   require_once APP_ROOT . '/src/Domain/Entities/RolEntity.php';
   require_once APP_ROOT . '/src/Infrastructure/Database/Repositories/MySQLUsuarioRepository.php';
   require_once APP_ROOT . '/src/Infrastructure/Database/Repositories/MySQLRolRepository.php';
   require_once APP_ROOT . '/src/Domain/Models/AutenticadorModel.php';

   require_once APP_ROOT . '/src/Infrastructure/Routing/GestorRutas.php';
   require_once APP_ROOT . '/src/Application/Services/Login/LoginService.php';

   ErrorManager::register();

   Config::init();

   GestorRutas::init();
   LoginService::init();

   GestorRutas::getController();