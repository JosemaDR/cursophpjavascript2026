<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';

      var_dump(Config::class);
?>

   <main>
      <h1>CONTACTAR</h1>

      <section>
         <p>
            💬 <?php echo $resultado;?>
         </p>
      </section>
   </main>

<?php
   require_once APP_ROOT . '/vistas/footer.generico.php';
?>