-- ─────────────────────────────────────────────────────────────
-- schema.sql  —  Base de datos DigitalShelf
--
-- Ejecutar:
--   mysql -u root -p < php/schema.sql
-- ─────────────────────────────────────────────────────────────

CREATE DATABASE IF NOT EXISTS tienda_digital
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE tienda_digital;

-- ── Pedidos ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS pedidos (
    id            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_id      VARCHAR(32)     NOT NULL UNIQUE,      -- ORD-20250527-XXXX
    buyer_name    VARCHAR(200)    NOT NULL,
    buyer_email   VARCHAR(200)    NOT NULL,
    subtotal      DECIMAL(10,2)   NOT NULL DEFAULT 0,
    descuento     DECIMAL(10,2)   NOT NULL DEFAULT 0,
    iva           DECIMAL(10,2)   NOT NULL DEFAULT 0,
    total         DECIMAL(10,2)   NOT NULL DEFAULT 0,
    status        ENUM('pendiente','completado','fallido','reembolsado')
                                  NOT NULL DEFAULT 'pendiente',
    txn_token     VARCHAR(64)     NULL,                 -- token simulado de pasarela
    created_at    DATETIME        NOT NULL,
    completed_at  DATETIME        NULL,
    PRIMARY KEY   (id),
    INDEX idx_order_id   (order_id),
    INDEX idx_email      (buyer_email),
    INDEX idx_status     (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Líneas de pedido ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS pedido_items (
    id            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    pedido_id     BIGINT UNSIGNED NOT NULL,
    product_id    INT UNSIGNED    NOT NULL,
    product_name  VARCHAR(200)    NOT NULL,
    file_name     VARCHAR(200)    NOT NULL,
    price         DECIMAL(10,2)   NOT NULL,
    qty           TINYINT UNSIGNED NOT NULL DEFAULT 1,
    line_total    DECIMAL(10,2)   NOT NULL,
    PRIMARY KEY   (id),
    FOREIGN KEY   (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    INDEX idx_pedido (pedido_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
