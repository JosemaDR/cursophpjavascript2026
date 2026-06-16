<?php
// El operador de @, totalmente desaconsejado en general y especialmente, a partir de la versión 8 de PHP,
// oculta que se vuelque un error al navegador porque lo sustituye por NULL.
// Depende de la configuración de PHP.
// No funciona con clases, funciones, o estructuras de control como if o foreach.
// Si la opción de configuración de PHP: track_errors, está activa, el último error ignorado por @, se guarda en la variable
// predefinida: $php_errormsg.
// $value = @$array['no_existe'];

/*
   Configuración de errores en entorno de NO PRODUCCIÓN: local, desarrollo, preproducción.

   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
*/

/*
   Configuración de errores en entorno cualquier entorno (incluyendo PRODUCCIÓN).

   En estos casos el informe de errores, no aparecen por pantalla, sino que van a un fichero de texto
   que contiene los posibles errores.

   error_reporting(E_ALL);
   ini_set('display_errors', 0);
   ini_set('log_errors', 1);
   ini_set('error_log', 'ruta_al_fichero_log_incluido');
*/

/*
TRY-CATCH
*/

class RangoIncorrectoException extends Exception {}

try {
   // Todo el código que intento ejecutar y donde si hay un error capturable, será posible gestionarlo.
   //$res = 10/0;
   //$value = $array['no_existe'];
   $limiteSuperiorRango = 100;
   $limiteInferiorRango = 0;
   $valorPrueba = 3000;

   if($valorPrueba > $limiteSuperiorRango || $valorPrueba < $limiteInferiorRango) {
      throw new RangoIncorrectoException('El rango indicado es inválido');
   }

} catch (DivisionByZeroError $e) {
   //echo 'Uff, ni se te ocurra dividir por cero............' . $e->getMessage();
   //header('Location:https://www.w3chools.com');
} catch (RangoIncorrectoException $e) {
   echo 'El limite indicado es incorrecto: ' . $e->getMessage();
} catch(Exception $e) {
   echo 'Ha ocurrido un error de excepción a nivel de usuario: ' . $e->getTraceAsString();
} catch(Error $e) {
   echo 'Ha ocurrido un error de excepción a nivel de PHP interno: ' . $e->getTraceAsString();
}

set_exception_handler(function ($exception) {
   echo 'Ha ocurrido una excepción, diríjase al servicio técnico e indíqueles el error que se muestra: ',
   $exception->getMessage();
});

set_error_handler(function($exception) {
   echo 'Ha ocurrido una excepción, diríjase al servicio técnico e indíqueles el error que se muestra: ',
   $exception->getMessage();
});

/*
Errores capturables:
   - Excepciones.
   - Errores recuperables (warnings, notice, deprecated: set_error_handler()).

Errores no recuperables:
   - Parse error.
   - Out of memory.
   - Errores de servidor.
*/