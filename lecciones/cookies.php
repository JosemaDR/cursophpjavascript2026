<?php
/*
   Las cookies son pequeñas dosis de datos bajo un nombre, con una caducidad y pueden
   tener otros datos de seguridad.

   Sintaxis en general:
   "usuario=Juan; expires=Fri, 31 Dec 2026 23:59:59 GMT; path=/"
*/
?>

<script>
// ESTABLECER CON JAVASCRIPT:
document.cookie = "pruebaJSCursoWEB=establecer; expires=Fri, 31 Dec 2026 23:59:59 GMT; path=/";

// LEER LAS COOKIES (DEVUELVE TODAS COMO CADENA):
console.log(document.cookie);

// ACTUALIZAR UNA COOKIE:
document.cookie = "pruebaJSCursoWEB=actualizar; expires=Fri, 31 Dec 2026 23:59:59 GMT; path=/";
console.log(document.cookie);

// ¿COMO OBTENGO UNA COOKIE EN CONCRETO?
function getCookie(cookieBuscada) {
   const cookies = document.cookie.split("; ");
   for(let cookie of cookies) {
      const [nombreCookie, valorCookie] = cookie.split("=");

      if(nombreCookie === cookieBuscada) {
         return decodeURIComponent(valorCookie);
      }
   }
   return null;
}

console.log(getCookie('YOQUESE'));

// ELIMINAR UNA COOKIE (indico una fecha de expiracion pasada):
document.cookie = "pruebaJSCursoWEB=borrar; expires=Fri, 31 Dec 2025 23:59:59 GMT; path=/";
console.log(document.cookie);
</script>

<?php
// ESTABLECER LA COOKIE:
setcookie('cookieConPHP', 'estableciendo', time() + 86400, "/");  // Expira en un día.
setcookie('cookieConPHP2', 'estableciendo2', time() + 3600, "/", "", true, true);  // Expira en un día.

// ¡OJO! Como las cookies se establecen en las cabeceras de respuesta del protocolo HTTP,
// al igual que ocurre con las sesiones o cualquie modificiación de cabeceras como la
// redirección a otra url con header('Location:urlNueva');, no debemos haber enviado nada
// al navegador como salida porque entonces ya se habrán enviado todas las cabeceras.

// LEER COOKIES EN PHP:
echo '<pre>';
var_dump($_COOKIE);
echo '</pre>';

echo '<h1>', $_COOKIE['cookieConPHP2'], '</h1>';

// Ejemplo para leer si existe:
if(isset($_COOKIE['usuario'])) {
   echo '<div>Hola, ' . htmlspecialchars($_COOKIE['usuario']), '</div>';
}

// ACTUALIZAR (LA VOLVEMOS A ESTABLECER CON LOS DATOS CAMBIADOS)
setcookie('cookieConPHP', 'actualizando', time() + 86400, "/");

// ELIMINAR
setcookie('cookieConPHP', 'estableciendo', time() - 86400, "/");
unset($_COOKIE['cookieConPHP']);
echo '<pre>';
var_dump($_COOKIE);
echo '</pre>';