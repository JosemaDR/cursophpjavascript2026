<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo Config::NOMBRE_APP; ?></title>
   <link rel="stylesheet" href="<?php echo Config::getRutaAPPWeb();?>assets/css/main.css">
   <script src="<?php echo Config::getRutaAPPWeb();?>assets/js/main.js" defer></script>
<?php
   //var_dump(GestorRutas::getRutaActual());
   if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] === '/carrito') {
      echo '<script src="' . Config::getRutaAPPWeb() . 'assets/js/carrito.js" defer></script>';
   }
?>
</head>
<body>