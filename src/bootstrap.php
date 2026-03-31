<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/Exceptions/Exceptions.php';
   require_once APP_ROOT . '/config/Config.php';

   Config::init();


   require_once APP_ROOT . '/src/Controllers/GestorRutas.php';