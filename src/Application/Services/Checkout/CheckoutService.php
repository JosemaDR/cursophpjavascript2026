<?php
defined('APP_ROOT') or header('Location: ../index.php');

class CheckoutService {
   private IPedidoRepository $pedidoRepo;
   private IFacturaRepository $facturaRepo;
   private FacturadorModel $facturador;

   public function __construct(
      IPedidoRepository $pedidoRepo,
      IFacturaRepository $facturaRepo,
      FacturadorModel $facturador
   ) {
      $this->pedidoRepo = $pedidoRepo;
      $this->facturaRepo = $facturaRepo;
      $this->facturador = $facturador;
   }

   /**
    * Procesa la compra completa: Pedido + Factura
    */
   public function procesarCompra(int $usuarioId, array $itemsCarrito): bool {
      try {
         // 1. Calculamos totales usando el Modelo de Dominio
         // $itemsCarrito debe ser un array de objetos LineaPedidoEntity o similar
         $totales = $this->facturador->calcularTotales($itemsCarrito);

         // 2. Creamos la Entidad Pedido
         $pedido = new PedidoEntity(
               null, 
               $usuarioId, 
               date('Y-m-d H:i:s'), 
               'pagado', // Al ser digital, asumimos pago inmediato
               $totales['total'],
               $itemsCarrito
         );

         // 3. Persistimos el Pedido (obtenemos el ID generado)
         $pedidoId = $this->pedidoRepo->save($pedido);

         if ($pedidoId > 0) {
               // 4. Generamos el número de factura y la entidad Factura
               $numFactura = $this->facturaRepo->getSiguienteNumeroFactura();
               
               $factura = new FacturaEntity(
                  null,
                  $pedidoId,
                  $numFactura,
                  date('Y-m-d H:i:s'),
                  $totales['base'],
                  21.0, // IVA por defecto
                  $totales['total']
               );

               // 5. Creamos las líneas de factura a partir de las del pedido
               $lineasFactura = [];
               foreach ($itemsCarrito as $item) {
                  $lineasFactura[] = new LineaFacturaEntity(
                     null,
                     0, // El ID se asignará en el repo
                     $item->getNombreProducto(), // Necesitas este getter en la entidad línea
                     $item->getCantidad(),
                     $item->getPrecioUnitario(),
                     ($item->getCantidad() * $item->getPrecioUnitario())
                  );
               }

               // 6. Persistimos la Factura y sus líneas
               return $this->facturaRepo->save($factura, $lineasFactura);
         }

         return false;
      } catch (Exception $e) {
         // Loguear error: $e->getMessage();
         return false;
      }
   }
}