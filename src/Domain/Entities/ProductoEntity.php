<?php
defined('APP_ROOT') or header('Location: ../index.php');

class ProductoEntity {
   private ?int $id;
   private string $nombre;
   private string $descripcion;
   private float $precio;
   private string $imagen;

   public function __construct(?int $id, string $nombre, string $descripcion, float $precio, string $imagen) {
      $this->id = $id;
      $this->nombre = $nombre;
      $this->descripcion = $descripcion;
      $this->precio = $precio;
      $this->imagen = $imagen;
   }

   // Getters
   public function getId(): ?int { return $this->id; }
   public function getNombre(): string { return $this->nombre; }
   public function getDescripcion(): string { return $this->descripcion; }
   public function getPrecio(): float { return $this->precio; }
   public function getImagen(): string { return $this->imagen; }

   // Setters
   public function setNombre(string $nombre): void { $this->nombre = $nombre; }
   public function setDescripcion(string $descripcion): void { $this->descripcion = $descripcion; }
   public function setPrecio(float $precio): void { $this->precio = $precio; }
   public function setImagen(string $imagen): void { $this->imagen = $imagen; }
}