const carritoSection = document.getElementById('carrito');

const tablaCarrito = document.createElement('table');
const encabezado = document.createElement('tr');

const colID = document.createElement('th');
colID.textContent = 'ID';
const colNombre = document.createElement('th');
colNombre.textContent = 'Nombre';
const colDescripcion = document.createElement('th');
colDescripcion.textContent = 'Descripción';
const colUnidades = document.createElement('th');
colUnidades.textContent = 'Unidades';
const colPrecio = document.createElement('th');
colPrecio.textContent = 'Precio';
const colTotalLinea = document.createElement('th');
colTotalLinea.textContent = 'Total línea';

encabezado.appendChild(colID);
encabezado.appendChild(colNombre);
encabezado.appendChild(colDescripcion);
encabezado.appendChild(colUnidades);
encabezado.appendChild(colPrecio);
encabezado.appendChild(colTotalLinea);

tablaCarrito.appendChild(encabezado);

carritoSection.appendChild(tablaCarrito);

// const tablaCarrito = document.createElement('table');
// const encabezado = document.createElement('tr');
// tablaCarrito.appendChild(encabezado);

// const thProducto = document.createElement('th');
// thProducto.textContent = 'Producto';
// encabezado.appendChild(thProducto);
// const thPrecio = document.createElement('th');
// thPrecio.textContent = 'Precio';
// encabezado.appendChild(thPrecio);
// const thCantidad = document.createElement('th');
// thCantidad.textContent = 'Cantidad';
// encabezado.appendChild(thCantidad);
// const thTotal = document.createElement('th');
// thTotal.textContent = 'Total';
// encabezado.appendChild(thTotal);
// const thAcciones = document.createElement('th');
// thAcciones.textContent = 'Acciones';
// encabezado.appendChild(thAcciones);
// carritoSection.appendChild(tablaCarrito);