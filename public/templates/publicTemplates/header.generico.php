<?php
   defined('APP_ROOT') or header('Location: ../index.php');
    // Usamos el nuevo método isLogged() del servicio
   $isLogged = LoginService::isLogged();
?>
   <header>
      <nav class="navbar">
         <div class="logo">
            <a href="<?= Config::getRutaAPPWeb() ?>index.php/">Mi Tienda Pro</a>
         </div>
         
         <ul class="nav-links">
            <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/">Inicio</a></li>
            <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/catalogo">Catálogo</a></li>
            <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/contactar">Contacto</a></li>

            <?php if ($isLogged): ?>
               <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/carrito">Carrito</a></li>
               
               <?php if (LoginService::getRol() === 1): ?>
                  <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/admin" class="btn-admin">Panel Admin</a></li>
               <?php endif; ?>

               <li class="user-info">
                  <span>Hola, <strong><?= $_SESSION['user_nombre'] ?? 'invitado' ?></strong></span>
                  <a href="<?= Config::getRutaAPPWeb() ?>index.php/login/salir" class="btn-logout">Salir</a>
               </li>
         <?php else: ?>
               <li><a href="<?= Config::getRutaAPPWeb() ?>index.php/login" class="btn-login">Identificarse</a></li>
         <?php endif; ?>
      </ul>
   </nav>
</header>