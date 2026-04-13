<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Models/ProductoModel.php';

   if(count($urlPartes) >= 3) {
      switch($urlPartes[1]) {
         case 'alta':
            altaProducto();
            break;
         case 'editar':
            editarProducto($urlPartes[2]);
            break;
         case 'eliminar':
            eliminarProducto($urlPartes[2]);
            break;
         default:
            verProducto($urlPartes[2]);
      }
   }

   function altaProducto(){
      require_once APP_ROOT . '/vistas/producto.alta.php';
   }

   function editarProducto($producto){
      require_once APP_ROOT . '/vistas/producto.editar.php';
   }

   function eliminarProducto($producto){
      require_once APP_ROOT . '/vistas/producto.eliminar.php';
   }

   function verProducto($producto){
      require_once APP_ROOT . '/vistas/producto.php';
   }