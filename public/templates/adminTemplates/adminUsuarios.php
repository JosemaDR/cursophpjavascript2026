<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

<?php 
   defined('APP_ROOT') or header('Location: ../index.php'); 
   $user = $data['usuario_editar'] ?? null;
   $roles = $data['roles'] ?? [];
   $titulo = $user ? "Editar Usuario: " . $user->getUsuario() : "Crear Nuevo Usuario";
   $accion = $user ? "admin/usuarios/actualizar" : "admin/usuarios/guardar";
?>

<main class="admin-container">
   <section class="form-card">
      <h2><?= $titulo ?></h2>
      
      <form action="<?= $accion ?>" method="post">
         <?php if ($user): ?>
               <input type="hidden" name="id" value="<?= $user->getId() ?>">
         <?php endif; ?>

         <div class="form-group">
               <label for="usuario">Nombre de Usuario</label>
               <input type="text" name="usuario" id="usuario" required 
                     value="<?= $user ? $user->getUsuario() : '' ?>" 
                     <?= $user ? 'readonly' : '' ?> 
                     placeholder="Ej: juan_perez">
               <?php if ($user): ?><small>El nombre de usuario no se puede modificar.</small><?php endif; ?>
         </div>

         <div class="form-group">
               <label for="clave">Contraseña</label>
               <input type="password" name="clave" id="clave" 
                     <?= $user ? '' : 'required' ?> 
                     placeholder="<?= $user ? 'Dejar en blanco para no cambiar' : '********' ?>">
               <?php if ($user): ?>
                  <small>Solo rellena este campo si deseas cambiar la contraseña actual.</small>
               <?php endif; ?>
         </div>

         <div class="form-group">
               <label for="role_id">Rol de Usuario</label>
               <select name="role_id" id="role_id" required>
                  <?php foreach ($roles as $rol): ?>
                     <option value="<?= $rol->getId() ?>" 
                           <?= ($user && $user->getRoleId() === $rol->getId()) ? 'selected' : '' ?>>
                           <?= $rol->getNombre() ?>
                     </option>
                  <?php endforeach; ?>
               </select>
         </div>

         <div class="form-actions">
               <a href="admin/usuarios" class="btn-cancel">Volver al listado</a>
               <button type="submit" class="btn-save">
                  <?= $user ? 'Actualizar Usuario' : 'Registrar Usuario' ?>
               </button>
         </div>
      </form>
   </section>
</main>