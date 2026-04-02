<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class ErrorLogListener implements ListenerInterface {
      public function handle($data) {
         echo '<h3>Ejecución respuesta al evento realizada: ErrorLog.</h3>';
      }
   }