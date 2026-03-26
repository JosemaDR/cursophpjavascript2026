<?php
echo '<style>
   table, th, td {
      border: 1px solid black;
   }';
echo '</style>';

$file = 'customers-100.csv';
$fcsv = fopen($file, 'r');
   echo '<table><tr>';
   $linea = fgetcsv($fcsv);
   foreach($linea as $columna) {
      echo '<th>' . $columna . '</th>';
   }
   echo '</tr>';

   while(!feof($fcsv)) {
      $linea = fgetcsv($fcsv);
      echo '<tr>';
      foreach($linea as $campo) {
         echo '<td>' . $campo . '</td>';
      }
      echo '</tr>';
   }
   echo '</table>';
fclose($fcsv);