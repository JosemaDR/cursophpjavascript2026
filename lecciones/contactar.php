<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CURSO DE PROGRAMACIÓN WEB: CONTACTAR</title>
      <style>
         body {
            font-family: Verdana, Arial, sans-serif;
            font-size: 19px;
         }
      </style>
   </head>
   <body>
      <h1>CONTACTAR</h1>
      <p>
         Si deseas contactarnos, por favor envíanos un correo electrónico a
         <a href="mailto:prueba@gmail.com">
            prueba@gmail.com
         </a>
      </p>
      <?php
         $uno = 1;
         $dos = 2;
         $tres = 3;

         echo '<div>',
            $uno,
            '<br/>',
            $dos,
            '<br/>',
            $tres,
            '</div>';
         
         echo '<pre>';
         $valorDevuelto = var_dump($uno, $dos, $tres);
         var_dump($valorDevuelto);
         echo '</pre>';

         echo '<pre>';
         $valorDevuelto = print_r($uno);
         var_dump($valorDevuelto);
         echo '</pre>';

         printf('%d - %s', 5+3, 'AB' . (8/2));

         echo 5+3, '-', 'AB' . (8/2);

         function mifuncion(){
            return '<h2>Dentro de mifuncion()</h2>';
         }

         $fn = function (){
            return '<h2>Dentro de función anónima</h2>';
         };

         $fn2 = 'mifuncion';
         $var1 = '9797090897';

         $saludo = [
            'key1' => 345,
            'key2' => 25,
            'key3' => 'Hola'
         ];

         class Saludo {
            public $key1 = 345;
            public $key2 = 25;

            public function key3(){
               return 'Dentro de método key3()';
            }
         }

         $objSaludo = new Saludo();

         echo "<br /><strong>#--$var1--#<strong>";
         echo "<br /><strong>#--{$fn()}--#<strong>";
         echo "<br /><strong>#--{$fn2()}--#<strong>";
         echo "<br /><strong>#--$saludo--#<strong>";
         echo "Saludando: {$saludo['key3']}";
         echo "<br /><strong>#--{$objSaludo->key1}--#<strong>";
         echo "<br /><strong>#--{$objSaludo->key3()}--#<strong>";
      ?>
   </body>
</html>