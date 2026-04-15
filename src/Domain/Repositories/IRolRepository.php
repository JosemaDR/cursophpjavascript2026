<?php
defined('APP_ROOT') or header('Location: ../index.php');

interface IRolRepository {
   public function findAll(): array;
   public function findById(int $id): ?RolEntity;
}