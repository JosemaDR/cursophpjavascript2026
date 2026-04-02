<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   interface ListenerInterface {
      public function handle($data);
   }