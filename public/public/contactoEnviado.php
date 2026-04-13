<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';
?>

   <main>
      <section>
         <h3>Su mensaje de contacto ha sido enviado correctamente, en breve nos pondremos responderemos a 
         su solicitud. <sub>Muchas gracias por contactar con nosotros.</sub>
         </h3>
         <p>
            <a href="<?php echo Config::getRutaAPPWeb(); ?>">Volver al Inicio</a>
         </p>
      </section>
   </main>

<?php
   require_once APP_ROOT . '/vistas/footer.generico.php';
?>