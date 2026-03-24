<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $nombreApp; ?></title>
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      }

      h1 {
         text-align: center;
      }
   </style>
</head>
<body>
   <h1><?php echo $nombreApp; ?></h1>
</body>
</html>

<?php
$resultado = 456 * 45 + 877987;
?>

<p>
   El resultado de calcular estos importes es: <?php echo  $resultado;?>
</p>
// $prueba = 'Esto es una prueba';

// $miPlantilla = "<div id=\"contenedorPrincipal\" onclick=\"alert(\"Hola desde la plantilla-cadena\");\"><p>lkñkljkjlñkj 8888979807 lkj akjdf ljalkdfj 
// lajdsfñlkjañkljdf ñklaj fñkljda fñlkjda ñflkjadñlkfj ñlkjaddf
// lkajdlfkj ñlakjf ñkljdss fñlkjasd
// ñlkj ñlkj ñlkj
// ñklj ñlkj lñkj87po87 dpfljaj dfdjñalkjf ñlkadjf 
// aljsdfp9897a90d8s7f98a flj 
// asljdflkja ñfadkljf </p>$prueba</div>";

// $nowdoc = 'kjh jh lkjh lkjh lkjh lkjhf lkjhalkfh kjah
// fklhjalk f9087dd98f pajfj ñlasdjfl
// ñdajflñkdjf p98po';

// echo $nowdoc, $miPlantilla, count($_GLOBALS);


// //SOLID Y CLEAN CODE
// $str = <<<CATALOGO_TEMPLATE
// Vamos a cambiar este texto para ver si <br />
// creamos una "cadena" larga \\que admita \'interpolaciones \tde código PHP
// <p>que nos permita crear plantillas. Ejemplo: $prueba.</p>
// CATALOGO_TEMPLATE;

// echo $miPlantilla;