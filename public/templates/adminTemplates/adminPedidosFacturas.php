<?php 
   defined('APP_ROOT') or header('Location: ../index.php'); 
   $pedido = $data['pedido'];
   $lineas = $pedido->getLineas();
?>

<main class="admin-container">
   <div class="admin-header">
      <h1>Detalle del Pedido #<?= $pedido->getId() ?></h1>
      <a href="admin/pedidos" class="btn-cancel">Volver al listado</a>
   </div>

   <section class="order-summary-card">
      <div class="info-grid">
         <div>
               <strong>Fecha:</strong> <?= $pedido->getFecha() ?>
         </div>
         <div>
               <strong>Estado Actual:</strong> 
               <span class="badge-status <?= $pedido->getEstado() ?>"><?= strtoupper($pedido->getEstado()) ?></span>
         </div>
      </div>

      <table class="admin-table detail-table">
         <thead>
               <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio Unit.</th>
                  <th>Subtotal</th>
               </tr>
         </thead>
         <tbody>
               <?php foreach ($lineas as $linea): ?>
                  <tr>
                     <td><?= htmlspecialchars($linea->getNombreProducto()) ?></td>
                     <td><?= $linea->getCantidad() ?></td>
                     <td><?= number_format($linea->getPrecioUnitario(), 2) ?>€</td>
                     <td><?= number_format($linea->getPrecioUnitario() * $linea->getCantidad(), 2) ?>€</td>
                  </tr>
               <?php endforeach; ?>
         </tbody>
         <tfoot>
               <tr>
                  <td colspan="3" class="text-right"><strong>TOTAL:</strong></td>
                  <td class="total-cell"><?= number_format($pedido->getTotal(), 2) ?>€</td>
               </tr>
         </tfoot>
      </table>
   </section>
</main>