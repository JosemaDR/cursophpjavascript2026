<?php
/*
   Paso por valor (es una copia)
*/
$unMensajeCualquiera = 'Esto es una prueba';

function saludo(string $unMensajeCualquiera): void {
   $unMensajeCualquiera = '7777777777777------XXXXXXXXXXXX- 333333333333333';
   echo '<h1>', $unMensajeCualquiera, '</h1>';
}

saludo($unMensajeCualquiera);
echo '<h1 style="color:red;">', $unMensajeCualquiera, '</h1>';

/*
   Paso de valor por referencia a funciones.
   Con este sistema, indicamos que trabajamos con la dirección de memoria
   de la variable directamente y no con una copia del valor.
   Si cambio el valor de la variable pasada, estoy cambiando el valor en la zona
   de memoria de esa variable y por tanto cambiamos el dato original.
*/
function setSaludo(string &$unMensajeCualquiera): void {
   $unMensajeCualquiera = 'WWWWWWWWWWWWWWWWWWWWWWWWWWWWWW';
   echo '<h1 style="color:green;">', $unMensajeCualquiera, '</h1>';
}
setSaludo($unMensajeCualquiera);

echo '<h1 style="color:blue;">', $unMensajeCualquiera, '</h1>';