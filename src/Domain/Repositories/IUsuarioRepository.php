<?php
defined('APP_ROOT') or header('Location: ../index.php');

interface IUsuarioRepository {
   public function findByUsername(string $username): ?UsuarioEntity;
   public function findById(int $id): ?UsuarioEntity;
   public function save(UsuarioEntity $usuario): bool;
}