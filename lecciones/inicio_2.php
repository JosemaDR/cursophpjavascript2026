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

   <div>
      <?php
         $tituloLibro = 'Coraline';
         $autor = 'Neil Gaiman';
         $estrellas = 5 / 100;
         $cadenaPlantilla = 'El último libro incorporado en la biblioteca a sido %s,
         cuyo autor es %s y su puntuación es: %.2f sobre %d. Un caracter cualquiera: %c';

         $valorDevuelto = printf($cadenaPlantilla,
         $tituloLibro,
         $autor,
         $estrellas,
         100,
         87);

         $cadenaDevuelta = sprintf($cadenaPlantilla,
         $tituloLibro,
         $autor,
         $estrellas,
         100,
         87);

         var_dump($valorDevuelto, $cadenaDevuelta);
      ?>
   </div>
</body>
</html>