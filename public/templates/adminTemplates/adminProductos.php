<?php 
   defined('APP_ROOT') or header('Location: ../index.php'); 
   $prod = $data['producto'] ?? null;
   $titulo = $prod ? "Editar Producto #".$prod->getId() : "Alta de Nuevo Recurso";
   $accion = $prod ? "admin/productos/actualizar" : "admin/productos/guardar";
?>

<main class="admin-container">
   <section class="form-card">
      <h2><?= $titulo ?></h2>
      
      <form action="<?= $accion ?>" method="post" enctype="multipart/form-data">
         <?php if ($prod): ?>
               <input type="hidden" name="id" value="<?= $prod->getId() ?>">
         <?php endif; ?>

         <div class="form-group">
               <label for="nombre">Nombre del Recurso</label>
               <input type="text" name="nombre" id="nombre" required 
                     value="<?= $prod ? $prod->getNombre() : '' ?>">
         </div>

         <div class="form-group">
               <label for="precio">Precio (€)</label>
               <input type="number" step="0.01" name="precio" id="precio" required 
                     value="<?= $prod ? $prod->getPrecio() : '' ?>">
         </div>

         <div class="form-group">
               <label for="descripcion">Descripción</label>
               <textarea name="descripcion" id="descripcion" rows="4" required><?= $prod ? $prod->getNombre() : '' ?></textarea>
         </div>

         <div class="form-group">
               <label for="imagen">Imagen del Producto</label>
               <?php if ($prod): ?>
                  <p><small>Actual: <?= $prod->getImagen() ?></small></p>
               <?php endif; ?>
               <input type="file" name="imagen" id="imagen" <?= $prod ? '' : 'required' ?>>
         </div>

         <div class="form-actions">
               <a href="admin/productos" class="btn-cancel">Cancelar</a>
               <button type="submit" class="btn-save">Guardar Cambios</button>
         </div>
      </form>
   </section>
</main>