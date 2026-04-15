<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/src/Infrastructure/Http/Controllers/BaseController.php';
   require_once APP_ROOT . '/src/Application/Views/View.php';

   class CarritoController  extends BaseController {
      public function index(array $data = []){
         
      }
   }

   require_once APP_ROOT . '/public/templates/publicTemplates/carrito.php';