<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   require_once APP_ROOT . '/vistas/head.generico.php';
   require_once APP_ROOT . '/vistas/header.generico.php';
?>

   <main>
      <h2>Formulario de contacto</h2>

      <form action="" method="post" style="width:50%;" onsubmit="validarFormulario();">
         <fieldset style="margin:30px;">
            <legend>Su nombre y apellidos, por favor:</legend>
            <input type="text"
               placeholder="Indique su nombre"
               title="Indique su nombre"
               name="nombreContacto"
               id="nombreContacto"
               required />
            <input type="text"
               placeholder="Indique sus apellidos"
               title="Indique sus apellidos"
               name="apellidos"
               id="apellidosContacto"
               required />
         </fieldset>

         <section style="margin:30px;">
            <label for="emailContacto">
               Su email:
               <input type="email"
               placeholder="email@email.com"
               title="Escriba aquí su correo electrónico"
               name="emailContacto"
               id="emailContacto"
               required />
            </label>
         </section>

         <section style="margin:30px;">
            <label for="asuntoContacto">
               Indique el motivo por el que nos contacta:
               <input type="text"
                  placeholder="Indique el asunto de su contacto"
                  title="Indique el motivo de su contacto"
                  name="asuntoContacto"
                  id="asuntoContacto"
                  required />
            </label>
         </section>

         <section style="margin:30px;">
            <label for="mensajeContacto">
               Escriba su mensaje:
               <textarea placeholder="Escriba su mensaje"
                  title="Escriba el mensaje"
                  name="mensajeContacto"
                  id="mensajeContacto"
                  required></textarea>
            </label>
         </section>

         <input type="submit"
            value="Enviar mensaje"
            name="enviarMensaje"
            id="enviarMensaje"
            style="margin-left:30px;"
            onclick="validarFormulario();" />
      </form>
   </main>

<?php
   var_dump($_GET);
   var_dump($_POST);
   require_once APP_ROOT . '/vistas/footer.generico.php';
?>