<?php
declare(strict_types=1);

// TIPOS DE DATOS EN PHP:
// https://www.php.net/manual/es/language.types.php

$nombreCliente = '';
$importe = 8897907908;
$totalDespuesImpuestos = 98797.78;
$telefono = '654885875';

$nombreCliente = 'Yo';

$notas = [5, 7, 10, 7, 8];

$notas = [
   3 => 5,
   'mates' => 7,
   1000,
   15 => 10,
   'lengua' => 7,
   8
];

$notas[2] = 178;
$notas[] = 'Esto es una prueba a ver que pasa';

$prueba = [
   'a' => 2,
   'b' => 'ASDF',
   'c' => array(4, 5, 6)
];

$prueba[] = 'A ver que sale';
var_dump($prueba['c'][1]);