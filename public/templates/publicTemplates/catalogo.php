<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

<main class="container">
   <h1 class="page-title">Recursos Digitales</h1>
   
   <div class="product-grid">
      <?php foreach ($data['productos'] as $producto): ?>
         <article class="product-card">
               <img src="assets/img/<?= $producto->getImagen() ?>" alt="<?= $producto->getNombre() ?>">
               <div class="product-info">
                  <h3><?= $producto->getNombre() ?></h3>
                  <p class="description"><?= $producto->getDescripcion() ?></p>
                  <span class="price"><?= number_format($producto->getPrecio(), 2) ?>€</span>
                  
                  <form action="carrito/agregar" method="post">
                     <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                     <button type="submit" class="btn-add">Añadir al carrito</button>
                  </form>
               </div>
         </article>
      <?php endforeach; ?>
   </div>
</main>