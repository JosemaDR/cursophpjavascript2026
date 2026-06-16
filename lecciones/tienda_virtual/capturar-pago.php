<?php
/**
 * capturar-pago.php
 * ─────────────────────────────────────────────────────────────
 * Recibe el order_id y txn_token, verifica que el token
 * coincide con el pedido en BD, lo marca como "completado"
 * y simula el envío del email de confirmación.
 *
 * JS → POST php/capturar-pago.php
 *      { order_id, txn_token }
 *   ← { status:'completado', order_id }
 * ─────────────────────────────────────────────────────────────
 */

require_once __DIR__ . '/config.php';

soloMetodo('POST');
$body = leerBodyJson();

/* ── 1. Validar parámetros ── */
if (empty($body['order_id']) || empty($body['txn_token'])) {
    jsonResponse(['error' => 'Faltan order_id o txn_token'], 400);
}

$orderId  = trim($body['order_id']);
$txnToken = trim($body['txn_token']);

/* ── 2. Buscar el pedido en BD ── */
$db   = getDB();
$stmt = $db->prepare("SELECT * FROM pedidos WHERE order_id = :oid LIMIT 1");
$stmt->execute([':oid' => $orderId]);
$pedido = $stmt->fetch();

if (!$pedido) {
    jsonResponse(['error' => 'Pedido no encontrado'], 404);
}

/* ── 3. Idempotencia: si ya está completado, responder OK sin repetir ── */
if ($pedido['status'] === 'completado') {
    jsonResponse(['status' => 'completado', 'order_id' => $orderId]);
}

/* ── 4. Verificar que el token coincide (simulación de validación de pasarela) ── */
if ($pedido['txn_token'] !== $txnToken) {
    /* En producción esto indicaría un intento de fraude */
    error_log("[PAYSIM] Token inválido para pedido {$orderId}. Token recibido: {$txnToken}");
    jsonResponse(['error' => 'Token de transacción inválido'], 403);
}

/* ── 5. Marcar como completado ── */
$db->prepare("
    UPDATE pedidos
    SET status = 'completado', completed_at = NOW()
    WHERE order_id = :oid
")->execute([':oid' => $orderId]);

/* ── 6. Obtener líneas del pedido para el email ── */
$stmtItems = $db->prepare("
    SELECT * FROM pedido_items WHERE pedido_id = :pid
");
$stmtItems->execute([':pid' => $pedido['id']]);
$items = $stmtItems->fetchAll();

/* ── 7. Simular envío de email de confirmación ── */
_enviarEmailConfirmacion(
    $pedido['buyer_email'],
    $pedido['buyer_name'],
    $orderId,
    $items,
    (float) $pedido['subtotal'],
    (float) $pedido['descuento'],
    (float) $pedido['iva'],
    (float) $pedido['total']
);

/* ── 8. Responder al frontend ── */
jsonResponse([
    'status'   => 'completado',
    'order_id' => $orderId,
]);


/* ════════════════════════════════════════════════════════════
   Función interna: email de confirmación
   ════════════════════════════════════════════════════════════ */
function _enviarEmailConfirmacion(
    string $email,
    string $nombre,
    string $orderId,
    array  $items,
    float  $subtotal,
    float  $descuento,
    float  $iva,
    float  $total
): void {
    /* Construir filas HTML de los productos */
    $filasHtml = '';
    foreach ($items as $it) {
        $lt = fmtEur((float)$it['price'] * (int)$it['qty']);
        $filasHtml .= "
        <tr>
          <td style='padding:7px 0; border-bottom:1px solid #E3DFD6;'>{$it['product_name']} ×{$it['qty']}</td>
          <td style='padding:7px 0; border-bottom:1px solid #E3DFD6; text-align:right;'>{$lt}</td>
        </tr>";
    }

    $descHtml = $descuento > 0
        ? "<tr><td style='color:#3B6D11;'>Descuento aplicado</td>
               <td style='color:#3B6D11; text-align:right;'>−" . fmtEur($descuento) . "</td></tr>"
        : '';

    $html = "
    <!DOCTYPE html>
    <html lang='es'>
    <head><meta charset='UTF-8'></head>
    <body style='margin:0; padding:0; background:#F6F4EF; font-family: Arial, sans-serif;'>
      <div style='max-width:520px; margin:32px auto; background:#fff;
                  border-radius:12px; overflow:hidden; border:1px solid #E3DFD6;'>

        <!-- Cabecera -->
        <div style='background:#2B4E3F; padding:24px 28px; color:#fff;'>
          <h1 style='margin:0; font-size:1.3rem; font-weight:400;'>
            ¡Gracias por tu compra, {$nombre}!
          </h1>
          <p style='margin:6px 0 0; opacity:.75; font-size:13px;'>
            " . APP_NAME . " · Pedido {$orderId}
          </p>
        </div>

        <!-- Cuerpo -->
        <div style='padding:24px 28px;'>
          <table style='width:100%; border-collapse:collapse; font-size:14px;'>
            {$filasHtml}
            {$descHtml}
            <tr>
              <td style='padding:7px 0; color:#7A7569;'>IVA (21%)</td>
              <td style='padding:7px 0; color:#7A7569; text-align:right;'>" . fmtEur($iva) . "</td>
            </tr>
            <tr>
              <td style='padding:12px 0 0; font-size:16px; font-weight:700;'>Total cobrado</td>
              <td style='padding:12px 0 0; font-size:16px; font-weight:700;
                         text-align:right; color:#2B4E3F;'>" . fmtEur($total) . "</td>
            </tr>
          </table>

          <p style='margin:20px 0 8px; font-size:14px; color:#1C1A17;'>
            Tus archivos están disponibles en el área de cliente o
            con los enlaces de descarga de este recibo.
          </p>
          <p style='font-size:12px; color:#7A7569;'>
            Si tienes alguna duda escríbenos a
            <a href='mailto:" . APP_EMAIL . "' style='color:#2B4E3F;'>" . APP_EMAIL . "</a>
          </p>
        </div>

        <!-- Pie -->
        <div style='background:#F6F4EF; padding:14px 28px; font-size:11px; color:#7A7569;
                    border-top:1px solid #E3DFD6; text-align:center;'>
          © " . date('Y') . " " . APP_NAME . " · " . APP_DOMAIN . "
        </div>
      </div>
    </body>
    </html>";

    $asunto  = "Confirmación de pedido {$orderId} — " . APP_NAME;
    $headers = implode("\r\n", [
        'From: ' . APP_NAME . ' <' . APP_EMAIL . '>',
        'Reply-To: ' . APP_EMAIL,
        'Content-Type: text/html; charset=UTF-8',
        'MIME-Version: 1.0',
        'X-Mailer: PHP/' . PHP_VERSION,
    ]);

    /*
     * mail() básico — en producción sustituye por SMTP con
     * PHPMailer + SendGrid / Mailgun / Amazon SES para
     * mayor fiabilidad y no caer en spam.
     */
    mail($email, $asunto, $html, $headers);

    /* Log de simulación */
    error_log("[PAYSIM] Email de confirmación enviado a {$email} para pedido {$orderId}");
}
