<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>
<main class="login-container">
   <section class="login-card">
      <h2>Acceso al Sistema</h2>
      
      <?php if (isset($data['error'])): ?>
         <div class="alert-error"><?= $data['error'] ?></div>
      <?php endif; ?>

      <form action="login/entrar" method="post" class="login-form">
         <div class="form-group">
               <label for="usuario">Usuario</label>
               <input type="text" name="usuario" id="usuario" required placeholder="Tu nombre de usuario" />
         </div>

         <div class="form-group">
               <label for="clave">Contraseña</label>
               <input type="password" 
                     name="clave" 
                     id="clave" 
                     required 
                     placeholder="********"
                     title="Mínimo 10 caracteres: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial."
                     pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$" />
               <small class="help-text">Mín. 10 caracteres (A, a, 1, #)</small>
         </div>

         <div class="form-actions">
               <input type="submit" value="Entrar al Sistema" name="dologin" id="dologin" class="btn-submit" />
         </div>
      </form>
   </section>
</main>