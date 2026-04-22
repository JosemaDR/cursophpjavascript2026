<?php 
   defined('APP_ROOT') or header('Location: ../index.php'); 
   $rol = $data['rol_editar'] ?? null;
   $titulo = $rol ? "Editar Rol: " . $rol->getNombre() : "Crear Nuevo Rol";
   $accion = $rol ? "admin/roles/actualizar" : "admin/roles/guardar";
?>

<main class="admin-container">
   <section class="form-card">
      <h2><?= $titulo ?></h2>
      
      <form action="<?= $accion ?>" method="post">
         <?php if ($rol): ?>
               <input type="hidden" name="id" value="<?= $rol->getId() ?>">
         <?php endif; ?>

         <div class="form-group">
               <label for="nombre">Nombre del Rol</label>
               <input type="text" name="nombre" id="nombre" required 
                     value="<?= $rol ? htmlspecialchars($rol->getNombre()) : '' ?>" 
                     placeholder="Ej: Editor de Contenido">
               <small class="help-text">El nombre debe ser descriptivo (ej. Gestor de Ventas).</small>
         </div>

         <div class="form-actions">
               <a href="admin/roles" class="btn-cancel">Cancelar</a>
               <button type="submit" class="btn-save">
                  <?= $rol ? 'Actualizar Rol' : 'Crear Rol' ?>
               </button>
         </div>
      </form>
   </section>
</main>