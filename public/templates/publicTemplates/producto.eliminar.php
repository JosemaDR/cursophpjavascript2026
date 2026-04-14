<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/public/templates/publicTemplates/head.generico.php';
   require_once APP_ROOT . '/public/templates/publicTemplates/header.generico.php';
?>

   <main>
      <h1>PRODUCTO</h1>
      <p>
         <?php echo $producto; ?>
      </p>
   </main>

<?php
   require_once APP_ROOT . '/public/templates/publicTemplates/footer.generico.php';
?>