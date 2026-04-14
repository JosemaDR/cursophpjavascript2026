<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   if(isset($_SERVER['REQUEST_METHOD']) &&
   $_SERVER['REQUEST_METHOD'] === 'POST' &&
   isset($_POST['enviarMensaje']) &&
   isset($_POST['nombreContacto']) && strlen($_POST['nombreContacto']) > 0 &&
   isset($_POST['apellidos']) && strlen($_POST['apellidos']) > 0 &&
   isset($_POST['emailContacto']) && preg_match('/^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[\.][a-zA-Z]{3}$/', $_POST['emailContacto']) &&
   isset($_POST['asuntoContacto']) && strlen($_POST['asuntoContacto']) > 0 &&
   isset($_POST['mensajeContacto']) && strlen($_POST['mensajeContacto']) > 0 &&
   isset($_POST['mensajeContacto'])) {
      require_once APP_ROOT . '/public/templates/publicTemplates/contactoEnviado.php';
   }