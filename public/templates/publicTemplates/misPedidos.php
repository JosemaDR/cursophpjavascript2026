<?php defined('APP_ROOT') or header('Location: ../index.php'); ?>

<main class="container">
   <h2>Mis Compras</h2>
   <p>Gracias por tu confianza. Aquí tienes tus recursos listos para descargar:</p>

   <div class="orders-list">
      <?php foreach ($data['pedidos'] as $pedido): ?>
         <div class="order-item">
               <div class="order-header">
                  <span>Pedido #<?= $pedido->getId() ?></span>
                  <span>Fecha: <?= $pedido->getFecha() ?></span>
                  <span class="badge-success"><?= strtoupper($pedido->getEstado()) ?></span>
               </div>
               
               <ul class="download-links">
                  <?php foreach ($pedido->getLineas() as $linea): ?>
                     <li>
                           <span><?= $linea->getNombreProducto() ?></span>
                           <a href="descargas/archivo/<?= $linea->getProductoId() ?>" class="btn-download">
                              <i class="icon-download"></i> Descargar Recurso
                           </a>
                     </li>
                  <?php endforeach; ?>
               </ul>
               
               <div class="order-footer">
                  <a href="facturas/ver/<?= $pedido->getId() ?>" target="_blank">Ver Factura (PDF)</a>
               </div>
         </div>
      <?php endforeach; ?>
   </div>
</main>