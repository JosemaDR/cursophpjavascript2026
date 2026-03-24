<?php
   define('APP_ROOT', __DIR__);

?>

<script>
   console.info('APP_ROOT: <?php echo __DIR__; ?>');
</script>

<?php
   var_dump(APP_ROOT);
   require_once 'config/config.php';
   require_once 'vistas/inicio.php';
