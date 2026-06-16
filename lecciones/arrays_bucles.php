<?php
   /*
      Arrays: variables que pueden contener diferentes datos.
   */

   // $miArray    = [];          // Declaración de un array vacío, simple o rápido.
   // $otroArray  = array();     // Declaración de array tradicional, vacío con función array().

   // echo '<pre>';
   // // var_dump('Esto es un texto o cadena');
   // // var_dump(100);
   // // var_dump(0.5);
   // // var_dump(false);
   // var_dump($otroArray);
   // echo '<pre>';

   // Los valores diferentes que se guardan en un array, tienen una clave, índice o dirección para saber,
   // dentro del array, en que lugar está.
   // $miArray[] = 10;
   // $miArray[] = 5.5;
   // $miArray[] = 'Prueba';
   // $miArray[] = true;
   // $miArray[] = 1000;
   // $miArray[] = 'A';

   // $miArray[10] = 'ESTOY EN LA POSICIÓN 10';

   // // Esto en teoría y según la propia documentación oficial, sería un array asociativo,
   // // sin embargo, la realidad es que todo en PHP es un array por clave=valor.
   // $miArray['Cliente'] = 'Juanillo';

   // $miArray[] = 98698768976.87876;

   // $miArray[1] = 'Cinco con cinco';
   // echo '<pre>';
   // var_dump($miArray);
   // echo '<pre>';

/*
   Crear o declarar arrays con datos desde el principio:
*/
// $notas = [
//    'php' => 10,
//    'javascript' => 10,
//    'sql' => 10,
//    'css' => 10,
//    'html' => 10
// ];
// $inmuebles = array(
//    1 => 50,
//    2 => 75,
//    3 => 55,
//    4 => 91,
//    5 => 100
// );

// /*
//    - Bucle FOR: recorrer o iterar arrays con el clásico for.
//    - Operador ++: operador de autoincremento ----> $contador = $contador + 1; // Equivalente a $contador++.
//       - Para $variable = 1, si $variable++ ----> primero devuelve 1 y después vale 2: $variable = $variable + 1;
//       - Para $variable = 1, si ++$variable ----> primero vale 2: $variable = $variable + 1; y después devuelve ese 2.
//    - Operador <: operador menor que.
//    - Operador --: operador de autodecremento: mismas características que el de autoincremento pero restando 1
//                   cada vez.
// */
// $idProductos = [];
// for($contador = 0; $contador < 10;) {
//    $idProductos[] = (++$contador) . '_id';
// }
// echo '<pre>';
// var_dump($idProductos);
// echo '<pre>';

// $id = 0;
// for(;;) {
//    $idProductos[$id] = 0;
//    $id++;

//    if($id >= 10) {
//       break;
//    }
// }

// echo '<pre>';
// var_dump($idProductos);
// echo '<pre>';

// $otraVariable = 10;

// for($contador = 0, $indices = 'A', $otraVariable = 'AAA';
//    $contador < 10 && $otraVariable == 'A';
//    $contador++, $indices = $contador) {
//    $idProductos[] = (++$contador) . '_id';
// }

// /*
//    - Bucle WHILE: como for pero...
// */
// $contador = 0;
// while($contador < 10) {
//    $idProductos[] = (++$contador) . '_id';
// }
// echo '<pre>';
// var_dump($idProductos);
// echo '<pre>';

// $contador = 0;
// do {
//    $idProductos[] = (++$contador) . '_id';
// } while($contador < 10);


// /*
//    Bucle FOREACH: itera, recorre todos los valores de un array o una colección de datos y en base a ellos, voy
//    a repetir un código.
// */
// foreach($idProductos as $clave => $valor) {
//    echo '<div>Clave: ', $clave, '---> Valor: ', $valor, '</div>';
// }

$categoriasProductos = [
   'cursos' => array(
      'PHP' => 'Curso de PHP',
      'JavaScript' => 'Curso de JavaScript'
   ),
   'libros' => [
      'Introducción a la Programación',
      'PHP' => 'Introducción a PHP',
      'Videojuegos' => 'Uso de Godot'
   ],
   'hardware' => array(),
   'software' => array()
];

foreach($categoriasProductos as $categoriaTmp => $datosCategoria) {
   echo "<h3>Categoria: $categoriaTmp</h3>";

   foreach($datosCategoria as $clave => $productoTmp) {
      echo "<div>Producto: $productoTmp</div>";
   }
}

$categoriasProductos['libros']['PHP'] = array(
   'Introducción a PHP #script#',
   'Patrones de diseño con PHP',
   'Creación de APIs con PHP',
   'Arquitectura hexagonal con PHP'
);

$numeroLibros = count($categoriasProductos['libros']['PHP']);
echo '<ul>';
for($numero = 0; $numero < $numeroLibros; $numero++ ) {
   echo '<li>', $categoriasProductos['libros']['PHP'][$numero], '</li>';
}
echo '</ul>';

foreach($categoriasProductos['libros']['PHP'] as $clave => $tituloLibro) {
   $totalCaracteres = strlen($tituloLibro);
   $posicionCaracter = 0;
   while($posicionCaracter < $totalCaracteres) {
      if($tituloLibro[$posicionCaracter] == '#') {
         $categoriasProductos['libros']['PHP'][$clave][$posicionCaracter] = '_';
      }
      $posicionCaracter++;
   }
}
echo '<pre>';
var_dump($GLOBALS);
echo '<pre>';