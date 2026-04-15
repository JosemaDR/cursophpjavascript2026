<?php
defined('APP_ROOT') or header('Location: ../index.php');

class ProductoManagerModel {
   public function aplicarDescuento(ProductoEntity $producto, float $porcentaje): float {
      $precioOriginal = $producto->getPrecio();
      return $precioOriginal - ($precioOriginal * ($porcentaje / 100));
   }

   public function tieneStockBajo(int $cantidadActual): bool {
      $limiteCritico = 5;
      return $cantidadActual <= $limiteCritico;
   }
}