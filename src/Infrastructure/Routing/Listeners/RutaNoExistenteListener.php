<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class RutaNoExistenteListener implements ListenerInterface {
      public function handle($data) {
         echo '<h3>Ruta no existente: ', $data->getTraceAsString(), '</h3>';
      }
   }