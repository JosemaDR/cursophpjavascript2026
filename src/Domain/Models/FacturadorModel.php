<?php
defined('APP_ROOT') or header('Location: ../index.php');

class FacturadorModel {
   
   public function calcularTotales(array $lineas, float $ivaPorcentaje = 21.0): array {
      $base = 0.0;

      foreach ($lineas as $linea) {
         // precio * cantidad
         $base += ($linea->getPrecioUnitario() * $linea->getCantidad());
      }

      $importeIva = round($base * ($ivaPorcentaje / 100), 2);
      $total = round($base + $importeIva, 2);

      return [
         'base'  => round($base, 2),
         'iva'   => $importeIva,
         'total' => $total
      ];
   }

   public function validarImporteFactura(float $totalCalculado, float $totalEsperado): bool {
      // Evitamos problemas de precisión de coma flotante
      return abs($totalCalculado - $totalEsperado) < 0.001;
   }
}