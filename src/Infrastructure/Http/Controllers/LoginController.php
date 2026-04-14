<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Infrastructure/Http/Controllers/BaseController.php';
   require_once APP_ROOT . '/src/Application/Views/View.php';

   class LoginController extends BaseController {
      public function __construct() {
         $this->accion = GestorRutas::getAccionActual();
         $this->index();
      }

      public function index() {

      }

      public function getView() {
         View::render(GestorRutas::getAccionActual(), false);
      }
   }