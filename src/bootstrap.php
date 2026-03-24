<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   // Tenemos varios ficheros config.xxxx.php con la configuración de cada entorno.
   // Se usará el que sea del entorno en cuestión.
   // En herramientas conocidas suele ser un fichero config.template.php.
   // Nosotros, comenzaremos con POO y por tanto, tendremos un fichero solamente: Config.php.
   require_once APP_ROOT . '/config/Config.php';

   // El controlador GestorRutas.php elegirá la vista que después verá el usuario.
   require_once APP_ROOT . '/src/Controllers/GestorRutas.php';