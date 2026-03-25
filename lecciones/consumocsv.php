<?php
$file = 'customers-100.csv';
$fcsv = fopen($file, 'r');
//TODO: Validar que el fichero se ha abierto correctamente.
fclose($fcsv);