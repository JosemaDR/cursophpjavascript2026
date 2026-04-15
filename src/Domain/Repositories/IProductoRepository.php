<?php
defined('APP_ROOT') or header('Location: ../index.php');

interface IProductoRepository {
   public function findAll(): array;
   public function findById(int $id): ?ProductoEntity;
   public function save(ProductoEntity $producto): bool;
   public function delete(int $id): bool;
}