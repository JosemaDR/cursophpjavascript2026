<?php
   defined('APP_ROOT') or header('Location: ../index.php');
    // Usamos el nuevo método isLogged() del servicio
   $isLogged = LoginService::isLogged();
?>
   <header>
      <nav class="navbar">
         <div class="logo">
            <a href="<?= Config::getRutaAPPWeb() ?>">Mi Tienda Pro</a>
         </div>
         
         <ul class="nav-links">
            <li><a href="<?= Config::getRutaAPPWeb() ?>">Inicio</a></li>
            <li><a href="<?= Config::getRutaAPPWeb() ?>catalogo">Catálogo</a></li>
            <li><a href="<?= Config::getRutaAPPWeb() ?>contactar">Contacto</a></li>

            <?php if ($isLogged): ?>
               <li><a href="<?= Config::getRutaAPPWeb() ?>carrito">Carrito</a></li>
               
               <?php if (LoginService::getRol() === 1): ?>
                  <li><a href="<?= Config::getRutaAPPWeb() ?>admin" class="btn-admin">Panel Admin</a></li>
               <?php endif; ?>

               <li class="user-info">
                  <span>Hola, <strong><?= $_SESSION['user_nombre'] ?></strong></span>
                  <a href="<?= Config::getRutaAPPWeb() ?>login/salir" class="btn-logout">Salir</a>
               </li>
         <?php else: ?>
               <li><a href="<?= Config::getRutaAPPWeb() ?>login" class="btn-login">Identificarse</a></li>
         <?php endif; ?>
      </ul>
   </nav>
</header>