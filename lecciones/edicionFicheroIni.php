<?php
$nombreArchivo = "datos.ini";
$nuevaClave = "SuperPassword2026";

// Abrimos en modo r+ (lectura y escritura sin borrar el archivo)
$archivo = fopen($nombreArchivo, "r+");

if ($archivo) {
   $posicionInicioLinea = 0;

   // Leemos línea por línea
   while (($linea = fgets($archivo)) !== false) {
      // Buscamos si la línea comienza con "password="
      if (strpos($linea, 'password=') === 0) {
         
         // ¡Bingo! Retrocedemos el puntero al inicio de ESTA línea
         fseek($archivo, $posicionInicioLinea);
         
         // Escribimos la nueva línea. 
         // IMPORTANTE: PHP no "empuja" el resto del texto, sobrescribe.
         // Por eso, si la nueva clave es más corta, quedarían restos de la vieja.
         // Si es más larga, te comerías el texto de abajo.
         fwrite($archivo, "password=" . $nuevaClave . PHP_EOL);
         
         break; // Ya terminamos
      }
      // Guardamos la posición actual antes de leer la siguiente línea
      $posicionInicioLinea = ftell($archivo);
   }
   
   fclose($archivo);
   echo "Clave actualizada con éxito.";
}