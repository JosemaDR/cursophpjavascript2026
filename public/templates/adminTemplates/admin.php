<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

<main class="admin-container">
   <div class="admin-header">
      <h1>Gestión de Inventario</h1>
      <a href="admin/productos/nuevo" class="btn-primary"> + Nuevo Producto</a>
   </div>

   <table class="admin-table">
      <thead>
         <tr>
               <th>ID</th>
               <th>Imagen</th>
               <th>Nombre</th>
               <th>Precio</th>
               <th>Acciones</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($data['productos'] as $prod): ?>
               <tr>
                  <td>#<?= $prod->getId() ?></td>
                  <td><img src="assets/img/<?= $prod->getImagen() ?>" width="50"></td>
                  <td><strong><?= $prod->getNombre() ?></strong></td>
                  <td><?= number_format($prod->getPrecio(), 2) ?>€</td>
                  <td class="actions">
                     <a href="admin/productos/editar/<?= $prod->getId() ?>" class="btn-edit">Editar</a>
                     <a href="admin/productos/eliminar/<?= $prod->getId() ?>" 
                        class="btn-delete" 
                        onclick="return confirm('¿Estás seguro de eliminar este recurso?')">Eliminar</a>
                  </td>
               </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</main>

<main class="admin-container">
   <div class="admin-header">
      <h1>Gestión de Usuarios</h1>
      <a href="admin/usuarios/nuevo" class="btn-primary">+ Nuevo Usuario</a>
   </div>

   <table class="admin-table">
      <thead>
         <tr>
               <th>ID</th>
               <th>Nombre de Usuario</th>
               <th>Rol</th>
               <th>Acciones</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($data['usuarios'] as $user): ?>
               <tr>
                  <td>#<?= $user->getId() ?></td>
                  <td><strong><?= $user->getUsuario() ?></strong></td>
                  <td>
                     <span class="badge-role <?= $user->getRoleId() === 1 ? 'admin' : 'client' ?>">
                           <?= $user->getRoleId() === 1 ? 'Administrador' : 'Cliente' ?>
                     </span>
                  </td>
                  <td class="actions">
                     <a href="admin/usuarios/editar/<?= $user->getId() ?>" class="btn-edit">Editar</a>
                     <?php if ($_SESSION['user_id'] !== $user->getId()): ?>
                           <a href="admin/usuarios/eliminar/<?= $user->getId() ?>" 
                              class="btn-delete" 
                              onclick="return confirm('¿Eliminar este usuario definitivamente?')">Eliminar</a>
                     <?php endif; ?>
                  </td>
               </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</main>

<main class="admin-container">
   <div class="admin-header">
      <h1>Roles y Permisos</h1>
      <a href="admin/roles/nuevo" class="btn-primary">+ Nuevo Rol</a>
   </div>

   <table class="admin-table">
      <thead>
         <tr>
               <th>ID</th>
               <th>Nombre del Rol</th>
               <th>Usuarios con este Rol</th>
               <th>Acciones</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($data['roles'] as $rol): ?>
               <tr>
                  <td>#<?= $rol->getId() ?></td>
                  <td>
                     <span class="badge-role <?= strtolower($rol->getNombre()) === 'administrador' ? 'admin' : 'client' ?>">
                           <?= htmlspecialchars($rol->getNombre()) ?>
                     </span>
                  </td>
                  <td>
                     <?= $data['conteo_usuarios'][$rol->getId()] ?? 0 ?> usuarios
                  </td>
                  <td class="actions">
                     <a href="admin/roles/editar/<?= $rol->getId() ?>" class="btn-edit">Editar</a>
                     
                     <?php if ($rol->getId() > 2): ?>
                           <a href="admin/roles/eliminar/<?= $rol->getId() ?>" 
                              class="btn-delete" 
                              onclick="return confirm('¿Eliminar este rol? Esto podría afectar a los usuarios asociados.')">Eliminar</a>
                     <?php else: ?>
                           <small class="text-muted">Protegido</small>
                     <?php endif; ?>
                  </td>
               </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</main>

<main class="admin-container">
   <div class="admin-header">
      <h1>Historial de Pedidos</h1>
      <div class="admin-filters">
         </div>
   </div>

   <table class="admin-table">
      <thead>
         <tr>
               <th>Pedido</th>
               <th>Fecha</th>
               <th>Cliente</th>
               <th>Total</th>
               <th>Estado</th>
               <th>Acciones</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($data['pedidos'] as $pedido): ?>
               <tr>
                  <td>#<?= $pedido->getId() ?></td>
                  <td><?= date('d/m/Y H:i', strtotime($pedido->getFecha())) ?></td>
                  <td><?= htmlspecialchars($data['usuarios'][$pedido->getUsuarioId()] ?? 'Usuario Desconocido') ?></td>
                  <td><strong><?= number_format($pedido->getTotal(), 2) ?>€</strong></td>
                  <td>
                     <form action="admin/pedidos/cambiar-estado" method="post" class="form-inline">
                           <input type="hidden" name="pedido_id" value="<?= $pedido->getId() ?>">
                           <select name="estado" onchange="this.form.submit()" class="status-select <?= $pedido->getEstado() ?>">
                              <option value="pendiente" <?= $pedido->getEstado() == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                              <option value="pagado" <?= $pedido->getEstado() == 'pagado' ? 'selected' : '' ?>>Pagado</option>
                              <option value="enviado" <?= $pedido->getEstado() == 'enviado' ? 'selected' : '' ?>>Enviado</option>
                              <option value="cancelado" <?= $pedido->getEstado() == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                           </select>
                     </form>
                  </td>
                  <td class="actions">
                     <a href="admin/pedidos/detalle/<?= $pedido->getId() ?>" class="btn-view">Ver Detalle</a>
                     <a href="admin/facturas/ver/<?= $pedido->getId() ?>" target="_blank" class="btn-invoice">📄 Factura</a>
                  </td>
               </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</main>