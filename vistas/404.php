<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';
?>

   <main>
      <p>❌ ¡Ups! No se han encontrado lo que estás buscando.</p>
      <p>
         Si quieres prueba a ir de nuevo al inicio de la aplicación para no perderte:
         <a href="<?php echo $config['rutaAPPWeb'];?>">
            👉 Ir al inicio de la Tienda virtual de recursos digitales
         </a>
      </p>
   </main>

<?php
   require_once APP_ROOT . '/vistas/footer.generico.php';