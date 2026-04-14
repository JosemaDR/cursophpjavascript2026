<?php
   defined('APP_ROOT') or header('Location: ../index.php');
?>
<main>
   <form action="login" method="post">
      <div>
         <label for="usuario">Usuario: </label>
         <input type="text" name="usuario" id="usuario" required />
      </div>
      <div>
         <label for="clave">Clave: </label>
         <input type="password" name="clave" id="clave" required />
      </div>
      <div>
         <input type="submit" value="Entrar" name="dologin" id="dologin" />
      </div>

   </form>

</main>