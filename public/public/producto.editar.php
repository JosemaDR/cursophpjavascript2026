<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';
?>

   <main>
      <h1>PRODUCTO</h1>
      <p>
         <?php echo $producto; ?>
      </p>
   </main>

<?php
   require_once APP_ROOT . '/vistas/footer.generico.php';
?>