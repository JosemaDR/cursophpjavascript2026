<?php
/**
 * config.php
 * ─────────────────────────────────────────────────────────────
 * Configuración central de la tienda.
 * ⚠️  Añade este archivo a .gitignore — nunca lo subas público.
 * ─────────────────────────────────────────────────────────────
 */

/* ── Base de datos ── */
define('DB_HOST', 'localhost');
define('DB_NAME', 'tienda_digital');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
define('DB_CHAR', 'utf8mb4');

/* ── App ── */
define('APP_NAME',   'DigitalShelf');
define('APP_DOMAIN', 'tudominio.com');
define('APP_EMAIL',  'noreply@tudominio.com');

/* ── IVA ── */
define('IVA_RATE', 0.21);

/* ── Catálogo (fuente de verdad en servidor) ──
   Los precios SIEMPRE se validan aquí, nunca
   se confía en el precio que envía el cliente.
─────────────────────────────────────────────── */
define('CATALOG', [
    1 => ['name' => 'Plantilla WordPress Pro',   'price' => 29.99, 'file' => 'plantilla-wp-pro.zip'],
    2 => ['name' => 'Pack Iconos SVG Premium',   'price' =>  9.99, 'file' => 'iconos-svg-premium.zip'],
    3 => ['name' => 'Curso JavaScript Avanzado', 'price' => 49.99, 'file' => 'curso-js-avanzado.zip'],
    4 => ['name' => 'UI Kit Figma Dark Mode',    'price' => 19.99, 'file' => 'ui-kit-figma-dark.zip'],
    5 => ['name' => 'Plugin WooCommerce PDF',    'price' => 14.99, 'file' => 'plugin-woo-pdf.zip'],
    6 => ['name' => 'Guía SEO Técnico 2025',     'price' =>  7.99, 'file' => 'guia-seo-2025.pdf'],
]);

/* ── Cupones válidos ── */
define('COUPONS', [
    'DIGITAL10'  => 0.10,
    'BIENVENIDO' => 0.15,
    'VERANO25'   => 0.25,
]);

/**
 * Devuelve una conexión PDO (singleton).
 */
function getDB(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHAR);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

/**
 * Genera un ID de pedido único.
 */
function generarOrderId(): string
{
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid('', true), -6));
}

/**
 * Genera un token de transacción ficticio (simula la pasarela).
 */
function generarTxnToken(): string
{
    return 'TXN-' . strtoupper(bin2hex(random_bytes(8)));
}

/**
 * Formatea un número como precio en euros.
 */
function fmtEur(float $n): string
{
    return number_format($n, 2, ',', '.') . ' €';
}

/**
 * Responde con JSON y termina la ejecución.
 */
function jsonResponse(array $data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Solo acepta el método indicado, si no responde 405.
 */
function soloMetodo(string $method): void
{
    if ($_SERVER['REQUEST_METHOD'] !== strtoupper($method)) {
        jsonResponse(['error' => 'Método no permitido'], 405);
    }
}

/**
 * Lee y decodifica el body JSON de la petición.
 */
function leerBodyJson(): array
{
    $raw  = file_get_contents('php://input');
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        jsonResponse(['error' => 'JSON inválido en el cuerpo de la petición'], 400);
    }
    return $data;
}
