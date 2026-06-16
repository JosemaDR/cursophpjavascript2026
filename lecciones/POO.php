<?php
// Clases: plantilla a partir de la cual, se generan objetos.
// Deben indicar las características que van a tener los objetos que van a salir
// de esa clase o plantilla.
// Deben indicar las posibles acciones que pueden realizar esos objetos.

// Objetos: conjunto de datos (propiedades, características, atributos) y
// de acciones que puedo crear de una clase. A la creación de un objeto a
// partir de una clase, se le llama INSTANCIAR UN OBJETO DE ESA CLASE.
// Cada objeto, aunque venga de la misma clase, puede tener su propio estado,
// que son los datos de ese objeto por cada característica o atributo.

// Miembros: los componentes de una clase: propiedades o atributos y métodos (acciones
// que puede hacer una clase).
// Atributos: características, propiedades, miembros de una clase.
// Métodos: acciones presentadas como funciones, que pertenecen a una clase.

class Usuario {
   private string $nombre;
   private string $apellidos;
   private string $usuario;
   private string $clave;
   private int $rol;

   public function __construct(string $nombre,
      string $apellidos,
      string $usuario,
      string $clave,
      int $rol) {

      $this->nombre = $nombre;
      $this->apellidos = $apellidos;
      $this->usuario = $usuario;
      $this->clave = $clave;
      $this->rol = $rol;
   }

   // Los getters y setters que son funciones (métodos porque pertenecen a una clase), que acceden a estas
   // propiedades o atributos privados para leer o asignar valores a éstos.
   public function getNombre(): string {
      return $this->nombre;
   }
   public function setNombre(string $nombre) {
      $this->nombre = $nombre;
   }
   public function getApellidos(): string {
      return $this->apellidos;
   }
   public function setApellidos(string $apellidos) {
      $this->apellidos = $apellidos;
   }
   public function getUsuario(): string {
      return $this->usuario;
   }
   public function setUsuario(string $usuario) {
      $this->usuario = $usuario;
   }
   public function getClave(): string {
      return $this->clave;
   }
   public function setClave(string $clave) {
      $this->clave = $clave;
   }
   public function getRol(): int {
      return $this->rol;
   }
   public function setRol(int $rol) {
      $this->rol = $rol;
   }

   public function autenticar() {
      echo '<h4>Autenticando usuario...', $this->usuario, '</h4>';
   }
}

// $usuarioPepe = new Usuario('Jose', 'D M', 'Pepe', '1234', 2);

// var_dump($usuarioPepe);

// $usuarioPepe->setClave('1235');
// echo $usuarioPepe->getClave();


//$usuarioA = new Usuario();

// $usuarioA->nombre = 'A';
// $usuarioA->apellidos = 'D M';
// $usuarioA->usuario = 'A';
// $usuarioA->clave = '1234';
// $usuarioA->rol = 2;

//$usuarioB = new Usuario();


//$usuarioC = new Usuario();


// echo '<pre>';
// var_dump($usuarioPepe);
// echo '</pre>';
// $usuarioPepe->autenticar();
// $usuarioNatalia->autenticar();
// $usuarioA->autenticar();

class UsuariosService {
   private static Usuario $usuario;

   public static function init(Usuario $usuario) {
      self::$usuario = $usuario;
   }

   // public static function insertUsuario(Usuario $usuario):void {
   //    echo '<h3>... Insertando el nuevo usuario' . $usuario->getUsuario() . '</h3>';
   // }
   public static function insertUsuario():void {
      echo '<h3>... Insertando el nuevo usuario' . self::$usuario->getUsuario() . '</h3>';
   }

   public static function updateUsuario():void {

   }

   public static function saveUsuario():void {

   }

   public static function deleteUsuario():void {

   }

   public static function getTodosUsuarios():array {
      return array();
   }
}

// $usuarioNuevo = new Usuario('A', 'BC', 'A', '1234', 2);
// UsuariosService::init($usuarioNuevo);

// UsuariosService::init(new Usuario('A', 'BC', 'A', '1234', 2));
// UsuariosService::insertUsuario();

// HERENCIA: extends
class UsuarioAdministrador extends Usuario {
   public function verificarAdmin() {
      echo 'Veroficando administrador...OK';
   }
}
$administrador = new UsuarioAdministrador('Z', 'ZZ', 'Z', '1232', 1);
echo $administrador->getApellidos();


class UsuarioCliente extends Usuario {}

class UsuarioProveedor extends Usuario {}

// POLIMORFISMO: interfaces que se aplican a las clases con implements.
// Es un contrato, donde se me obliga a crear los métodos de la interface en
// la clase que la implemente.
interface Admin {
   public function isAdmin();
   public function modifyRules();
   public function setAdmin();
}

class UsuarioGenerico implements Admin {
   public function isAdmin() {
      echo 'Es administrador';
   }

   public function modifyRules() {
      echo 'Modificando permisos...';
   }

   public function setAdmin() {
      echo 'El usuario ZZZ es un nuevo administrador';
   }
}

class UsuarioEditor implements Admin {
   public function isAdmin() {
      echo 'Es editor';
   }

   public function modifyRules() {
      echo 'No puede modificar permisos';
   }

   public function setAdmin() {
      echo 'No puede establecer nuevos administradores';
   }
}

$miAdmin = new UsuarioGenerico();
$miEditor = new UsuarioEditor();

$miAdmin->isAdmin();
$miEditor->isAdmin();