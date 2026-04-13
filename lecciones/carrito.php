<style>
.tabla-carrito { width: 100%; border-collapse: collapse; margin-top: 20px; }
.tabla-carrito th, .tabla-carrito td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
.controles-unidades { display: flex; align-items: center; gap: 10px; }
.unidades-valor { font-weight: bold; min-width: 20px; text-align: center; }
.total-grande { font-size: 1.4em; color: #2c3e50; }
.btn-borrar { color: #e74c3c; cursor: pointer; border: none; background: none; }
</style>
<script defer>
/**
 * Objeto Carrito: Gestiona datos y lógica de renderizado
 */
const Carrito = {
   // 1. EL ESTADO: Los datos dinámicos
   items: [
      { id: 101, nombre: 'Ratón Óptico', precio: 15.50, unidades: 1, desc: 'Negro, USB' },
      { id: 102, nombre: 'Teclado Mecánico', precio: 45.00, unidades: 1, desc: 'RGB, Switch Red' },
      { id: 103, nombre: 'Monitor 24"', precio: 120.00, unidades: 1, desc: 'Full HD' }
   ],

   // 2. INICIALIZADOR: Busca el contenedor y pinta por primera vez
   init() {
      this.render();
   },

   // 3. MÉTODOS DE LÓGICA (Modifican los datos)
   cambiarUnidades(id, delta) {
      const producto = this.items.find(item => item.id === id);
      if (producto) {
         producto.unidades += delta;
         // Si las unidades bajan de 1, eliminamos la línea
         if (producto.unidades < 1) {
               this.eliminarLinea(id);
         } else {
               this.render();
         }
      }
   },

   eliminarLinea(id) {
      if (confirm('¿Desea eliminar este producto del carrito?')) {
         this.items = this.items.filter(item => item.id !== id);
         this.render();
      }
   },

   calcularTotalCarrito() {
      return this.items.reduce((acc, item) => acc + (item.precio * item.unidades), 0);
   },

   // 4. MÉTODO DE RENDERIZADO (Crea el HTML dinámicamente)
   render() {
      const contenedor = document.getElementById('carrito');
      if (!contenedor) return;

      if (this.items.length === 0) {
         contenedor.innerHTML = '<div class="alert">El carrito está vacío.</div>';
         return;
      }

      // Construcción de la tabla
      let html = `
         <table class="tabla-carrito">
               <thead>
                  <tr>
                     <th>Producto</th>
                     <th>Precio</th>
                     <th>Unidades</th>
                     <th>Subtotal</th>
                     <th>Acciones</th>
                  </tr>
               </thead>
               <tbody>
      `;

      // Generamos las filas dinámicamente según el array de items
      this.items.forEach(item => {
         const subtotal = (item.precio * item.unidades).toFixed(2);
         html += `
               <tr>
                  <td>
                     <strong>${item.nombre}</strong><br>
                     <small>${item.desc}</small>
                  </td>
                  <td>${item.precio.toFixed(2)}€</td>
                  <td>
                     <div class="controles-unidades">
                           <button onclick="Carrito.cambiarUnidades(${item.id}, -1)">-</button>
                           <span class="unidades-valor">${item.unidades}</span>
                           <button onclick="Carrito.cambiarUnidades(${item.id}, 1)">+</button>
                     </div>
                  </td>
                  <td><strong>${subtotal}€</strong></td>
                  <td>
                     <button class="btn-borrar" onclick="Carrito.eliminarLinea(${item.id})">Eliminar</button>
                  </td>
               </tr>
         `;
      });

      // Cerramos tabla y añadimos el Gran Total
      html += `
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="3" style="text-align:right"><strong>TOTAL COMPRA:</strong></td>
                     <td colspan="2"><span class="total-grande">${this.calcularTotalCarrito().toFixed(2)}€</span></td>
                  </tr>
               </tfoot>
         </table>
         <div class="acciones-finales">
               <button onclick="window.location.href='catalogo'">Seguir comprando</button>
               <button class="btn-finalizar" onclick="alert('Enviando a PHP...')">Finalizar Pedido</button>
         </div>
      `;

      contenedor.innerHTML = html;
   }
};

// Arrancar el carrito cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => Carrito.init());
</script>
<main id="carrito"></main>