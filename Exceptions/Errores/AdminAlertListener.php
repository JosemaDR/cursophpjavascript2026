<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class AdminAlertListener implements ListenerInterface {
      public function handle($data) {
         echo '<h3>Ejecución respuesta al evento realizada: AdminAlert</h3>';
      }
   }