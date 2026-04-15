<?php
defined('APP_ROOT') or header('Location: ../index.php');

require_once APP_ROOT . '/src/Infrastructure/Http/Controllers/BaseController.php';
require_once APP_ROOT . '/src/Application/Services/Login/LoginService.php';
require_once APP_ROOT . '/src/Domain/Models/AutenticadorModel.php';
require_once APP_ROOT . '/src/Infrastructure/Database/Repositories/MySQLUsuarioRepository.php';
require_once APP_ROOT . '/src/Application/Views/View.php';

class LoginController extends BaseController {

   public function index(array $data = []) {
      $accion = GestorRutas::getAccionActual();

      switch($accion) {
         case '':
               // Mostramos el formulario (la vista que acabamos de maquetar)
               $this->renderView($data);
               break;

         case 'entrar':
               $this->procesarLogin();
               break;

         case 'salir':
               LoginService::logout();
               header('Location:' . Config::getRutaAPPWeb());
               exit;
      }
   }

   private function procesarLogin() {
      // 1. Instanciamos las dependencias
      $db = new DatabaseConnection();
      $repo = new MySQLUsuarioRepository($db);
      $autenticador = new AutenticadorModel($repo);

      // 2. Recogemos datos del formulario
      $usuario = $_POST['usuario'] ?? '';
      $clave = $_POST['clave'] ?? '';

      // 3. El Modelo toma la decisión
      $usuarioEntity = $autenticador->validarAcceso($usuario, $clave);

      if ($usuarioEntity) {
         // 4. Si es válido, el Service gestiona la sesión
         LoginService::doLogin($usuarioEntity);
         header('Location:' . Config::getRutaAPPWeb());
         exit;
      } else {
         // 5. Si falla, volvemos al index con un error para la vista
         $this->index(['error' => 'Usuario o contraseña incorrectos.']);
      }
   }
}