<?php
/**
 * crear-orden.php
 * ─────────────────────────────────────────────────────────────
 * Recibe el carrito desde el frontend, recalcula el total
 * en servidor (nunca se fía del precio del cliente),
 * guarda el pedido en BD y devuelve un token de transacción
 * simulado (lo que en producción haría la pasarela real).
 *
 * JS → POST php/crear-orden.php
 *      { items:[{id,qty},...], buyer:{nombre,email}, total }
 *   ← { order_id, total_fmt, txn_token }
 * ─────────────────────────────────────────────────────────────
 */

require_once __DIR__ . '/config.php';

soloMetodo('POST');
$body = leerBodyJson();

/* ── 1. Validar estructura mínima ── */
if (empty($body['items']) || !is_array($body['items']) || empty($body['buyer'])) {
    jsonResponse(['error' => 'Faltan datos: items o buyer'], 400);
}

$buyer = $body['buyer'];
if (empty($buyer['nombre']) || empty($buyer['email'])) {
    jsonResponse(['error' => 'Nombre y email del comprador son obligatorios'], 400);
}
if (!filter_var($buyer['email'], FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['error' => 'Email del comprador no es válido'], 400);
}

/* ── 2. Recalcular total en servidor usando el catálogo oficial ──
   ⚠️  Esto es clave: ignoramos el precio que manda el cliente
   y usamos el precio real del catálogo definido en config.php.
────────────────────────────────────────────────────────────────── */
$catalog  = CATALOG;
$subtotal = 0.0;
$lineas   = [];

foreach ($body['items'] as $item) {
    $id  = (int) ($item['id']  ?? 0);
    $qty = (int) ($item['qty'] ?? 0);

    if ($qty < 1 || $qty > 99) {
        jsonResponse(['error' => "Cantidad inválida para el producto #{$id}"], 400);
    }
    if (!isset($catalog[$id])) {
        jsonResponse(['error' => "Producto #{$id} no existe en el catálogo"], 400);
    }

    $prod      = $catalog[$id];
    $lineTotal = round($prod['price'] * $qty, 2);
    $subtotal += $lineTotal;

    $lineas[] = [
        'product_id'   => $id,
        'product_name' => $prod['name'],
        'file_name'    => $prod['file'],
        'price'        => $prod['price'],
        'qty'          => $qty,
        'line_total'   => $lineTotal,
    ];
}

$descuento   = 0.0;
$cupon_usado = null;

/* Cupón opcional */
if (!empty($body['coupon'])) {
    $cod = strtoupper(trim($body['coupon']));
    if (isset(COUPONS[$cod])) {
        $descuento   = round($subtotal * COUPONS[$cod], 2);
        $cupon_usado = $cod;
    }
}

$base_imponible = round($subtotal - $descuento, 2);
$iva            = round($base_imponible * IVA_RATE, 2);
$total          = round($base_imponible + $iva, 2);

/* ── 3. Guardar pedido en base de datos ── */
$db      = getDB();
$orderId = generarOrderId();

$db->prepare("
    INSERT INTO pedidos
        (order_id, buyer_name, buyer_email, subtotal, descuento, iva, total, status, created_at)
    VALUES
        (:oid, :name, :email, :sub, :desc, :iva, :total, 'pendiente', NOW())
")->execute([
    ':oid'   => $orderId,
    ':name'  => $buyer['nombre'],
    ':email' => $buyer['email'],
    ':sub'   => $subtotal,
    ':desc'  => $descuento,
    ':iva'   => $iva,
    ':total' => $total,
]);

$pedidoId = $db->lastInsertId();

/* Insertar líneas */
$stmtLinea = $db->prepare("
    INSERT INTO pedido_items
        (pedido_id, product_id, product_name, file_name, price, qty, line_total)
    VALUES
        (:pid, :prod_id, :prod_name, :file, :price, :qty, :lt)
");
foreach ($lineas as $l) {
    $stmtLinea->execute([
        ':pid'       => $pedidoId,
        ':prod_id'   => $l['product_id'],
        ':prod_name' => $l['product_name'],
        ':file'      => $l['file_name'],
        ':price'     => $l['price'],
        ':qty'       => $l['qty'],
        ':lt'        => $l['line_total'],
    ]);
}

/* ── 4. Simular llamada a la pasarela PaySim ──
   En producción aquí harías un curl() a Stripe/PayPal.
   Nosotros simplemente generamos un token ficticio
   y guardamos el estado "autorizado" en la BD.
────────────────────────────────────────────────── */
$txnToken = generarTxnToken();

$db->prepare("
    UPDATE pedidos SET txn_token = :tkn WHERE id = :id
")->execute([':tkn' => $txnToken, ':id' => $pedidoId]);

/* ── 5. Responder al frontend ── */
jsonResponse([
    'order_id'   => $orderId,
    'total'      => $total,
    'total_fmt'  => fmtEur($total),
    'txn_token'  => $txnToken,
]);
