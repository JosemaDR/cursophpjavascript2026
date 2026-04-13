<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

   <header>
      <div class="logo">
         <img src="<?php echo Config::getRutaAPPWeb();?>assets/img/logo.jpg" alt="Logo de la tienda virtual">
      </div>
      <h1><?php echo Config::NOMBRE_APP; ?></h1>
   </header>
   <nav>
      <a href="<?php echo Config::getRutaAPPWeb();?>index.php/">Inicio</a>
      <a href="<?php echo Config::getRutaAPPWeb();?>index.php/catalogo">Catalogo</a>
      <a href="<?php echo Config::getRutaAPPWeb();?>index.php/contactar">Contactar</a>
      <a href="<?php echo Config::getRutaAPPWeb();?>index.php/login">🚪 Entrar</a>
      <span> | </span>
      <a href="<?php echo Config::getRutaAPPWeb();?>index.php/carrito" title="Carrito de la compra">🛒</a>
   </nav>