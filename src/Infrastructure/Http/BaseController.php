<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   abstract class BaseController {
      protected string $accion;
      protected string $recurso;

      public function __construct() {
         $this->accion = GestorRutas::getAccionActual();
         $this->recurso = GestorRutas::getRutaActual();
         
         // Ejecutamos index automáticamente en todos los hijos
         $this->index();
      }

      // Forzamos a que todos los controladores tengan un index
      abstract public function index();

      // Método centralizado para llamar a la vista
      protected function renderView(array $data = [], bool $isAdmin = false) {
         View::render($this->accion, $isAdmin, $data);
      }
   }