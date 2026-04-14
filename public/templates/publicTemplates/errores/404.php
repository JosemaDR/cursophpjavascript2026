<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/public/templates/publicTemplates/head.generico.php';
   require_once APP_ROOT . '/public/templates/publicTemplates/header.generico.php';
?>

   <main>
      <p>❌ ¡Ups! No se han encontrado lo que estás buscando.</p>
      <p>
         Si quieres prueba a ir de nuevo al inicio de la aplicación para no perderte:
         <a href="<?php echo Config::getRutaAPPWeb();?>">
            👉 Ir al inicio de la Tienda virtual de recursos digitales
         </a>
      </p>
   </main>

<?php
   require_once APP_ROOT . '/public/templates/publicTemplates/footer.generico.php';