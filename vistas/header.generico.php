<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

   <header>
      <div class="logo">
         <img src="<?php echo $config['rutaAPPWeb'];?>assets/img/logo.jpg" alt="Logo de la tienda virtual">
      </div>
      <h1><?php echo $config['nombreAPP']; ?></h1>
   </header>
   <nav>
      <a href="<?php echo $config['rutaAPPWeb'];?>index.php/">Inicio</a>
      <a href="<?php echo $config['rutaAPPWeb'];?>index.php/carrito">Carrito</a>
      <a href="<?php echo $config['rutaAPPWeb'];?>index.php/contactar">Contactar</a>
   </nav>