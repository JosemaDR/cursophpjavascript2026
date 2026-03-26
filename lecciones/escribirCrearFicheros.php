<?php
   // $proveedores = [
   //    ['nombre' => 'Proveedor A', 'contacto' => 'Teléfono: 123-456-7890, Email:aaa@gmail.com'],
   //    ['nombre' => 'Proveedor B', 'contacto' => 'Teléfono: 987-654-3210, Email:bbb@gmail.com'],
   //    ['nombre' => 'Proveedor C', 'contacto' => 'Teléfono: 555-555-5555, Email:ccc@gmail.com']
   //    ];

   $proveedores = new stdClass();
   $proveedores->proveedorA = ['nombre' => 'Proveedor A', 'contacto' => 'Teléfono: 123-456-7890, Email:aaa@gmail.com'];
   $proveedores->proveedorB = ['nombre' => 'Proveedor B', 'contacto' => 'Teléfono: 123-456-7891, Email:bb@gmail.com'];

   $fo = fopen('proveedores.csv', 'a+');
   foreach($proveedores as $proveedor) {
      fputcsv($fo, $proveedor);
   }
   fclose($fo);
   // Si quiero editar un fichero, lo abro con 'r+' (lectura y escritura) o 'a+' (lectura y escritura o adición al final).
   // Si quiero editar un dato concreto, lo más sencillo es leer el contenido del fichero, modificarlo en memoria y luego escribirlo de nuevo.
   // Pero, si quiero modificar un dato concreto sin leer todo el fichero, puedo usar funciones como fseek() para mover el puntero del archivo a la posición deseada y luego escribir los datos.
   // Sin embargo, esto puede ser complicado si el nuevo dato tiene una longitud diferente al dato original, ya que podría sobrescribir datos adyacentes o dejar espacios vacíos.
   // $configIni = fopen('config.ini', 'w');
   // if ($configIni) {
   //    $contenido = "# Configuración de la base de datos\n";
   //    $contenido .= "[DATABASE]\n";
   //    $contenido .= "host=localhost\n";
   //    $contenido .= "username=Yomismo\n";
   //    $contenido .= "password=12345\n";
   //    $contenido .= "database=mi_base_de_datos\n";
   //    fwrite($configIni, $contenido);
   //    fclose($configIni);
   //    echo "Archivo config.ini creado con éxito.";
   // }

// $videos = [
//       [
//          'titulo' => 'Introducción a PHP',
//          'duracion' => '10:30',
//          'url' => 'https://example.com/videos/introduccion-php'
//       ],
//       [
//          'titulo' => 'Manipulación de Arrays en PHP',
//          'duracion' => '15:45',
//          'url' => 'https://example.com/videos/manipulacion-arrays-php'
//       ],
//       [
//          'titulo' => 'Conexión a Bases de Datos con PDO',
//          'duracion' => '20:00',
//          'url' => 'https://example.com/videos/conexion-bases-datos-pdo'
//       ]
// ];

// $videos[] = [
//       'titulo' => 'Manejo de Formularios en PHP',
//       'duracion' => '12:20',
//       'url' => 'https://example.com/videos/manejo-formularios-php'
// ];

// $jsonVideos = json_encode($videos, JSON_PRETTY_PRINT);
// file_put_contents('videos.json', $jsonVideos);

// $contenido = sprintf("{\n");
// $contenido .= sprintf("\t\"productos\": [\n");
// $contenido .= sprintf("\t\t{\n");
// $contenido .= sprintf("\t\t\t\"nombre\": \"E-book\",\n");
// $contenido .= sprintf("\t\t\t\"precio\": 9.99\n");
// $contenido .= sprintf("\t\t},\n");
// $contenido .= sprintf("\t\t{\n");
// $contenido .= sprintf("\t\t\t\"nombre\": \"Curso en línea\",\n");
// $contenido .= sprintf("\t\t\t\"precio\": 49.99\n");
// $contenido .= sprintf("\t\t}\n");
// $contenido .= sprintf("\t]\n");
// $contenido .= sprintf("}");

// $contenido = sprintf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
// $contenido .= sprintf("<biblioteca>\n");
// $contenido .= sprintf("\t<libro>\n");
// $contenido .= sprintf("\t\t<titulo>El Quijote</titulo>\n");
// $contenido .= sprintf("\t\t<autor>Miguel de Cervantes</autor>\n");
// $contenido .= sprintf("\t</libro>\n");
// $contenido .= sprintf("</biblioteca>");