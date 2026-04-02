<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';
?>

   <main>
      <p>❌ Ha ocurrido un error de servidor.</p>
      <p>
         Nuestros técnicos ya han sido avisados, vuelva dentro de unos minutos. Gracias y
         disculpe las molestias.
      </p>
   </main>

<?php
   require_once APP_ROOT . '/vistas/footer.generico.php';