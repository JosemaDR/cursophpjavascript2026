function validarFormulario(eventoEnvio) {
   let errores = [];

   const inputNombre = document.getElementById('nombreContacto');
   const inputApellidos = document.getElementById('apellidosContacto');
   const inputEmail = document.getElementById('emailContacto');
   const inputAsunto = document.getElementById('asuntoContacto');
   const inputMensaje = document.getElementById('mensajeContacto');

   const nombreRegex = /^[A-Z][a-zA-Z][a-zA-Z]+$/;
   const apellidosRegex = /^[a-zA-Z]+$/;
   const asuntoRegex = /^[a-zA-Z0-9\s]+$/;
   const mensajeRegex = /^[a-zA-Z0-9\s]+$/;
   const emailRegex = /^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[\.][a-zA-Z]{3}$/;

   if(!nombreRegex.test(inputNombre.value.trim())) {
      errores.push('El campo "Nombre" no es válido. Solo se permiten caracteres alfabéticos sin espacios ni símbolos.');
   }
   if (!apellidosRegex.test(inputApellidos.value.trim())) {
      errores.push('El campo "Apellidos" no es válido. Solo se permiten caracteres alfabéticos sin espacios ni símbolos.');
   }
   if (!asuntoRegex.test(inputAsunto.value.trim())) {
      errores.push('El campo "Asunto" no es válido. Solo se permiten caracteres alfanuméricos sin espacios ni símbolos.');
   }
   if (!emailRegex.test(inputEmail.value.trim())) {
      errores.push('El campo "Email" no es válido. Solo se permiten caracteres alfanuméricos sin espacios ni símbolos.');
   }
   if (!mensajeRegex.test(inputMensaje.value.trim())) {
      errores.push('El campo "Mensaje" no es válido. Solo se permiten caracteres alfanuméricos sin espacios ni símbolos.');
   }

/*   if (inputNombre.value.trim() === '') {
      errores.push('El campo "Nombre" es obligatorio.');
   }
   if (inputApellidos.value.trim() === '') {
      errores.push('El campo "Apellidos" es obligatorio.');
   }
   if (inputEmail.value.trim() === '') {
      errores.push('El campo "Email" es obligatorio.');
   }
   if (inputAsunto.value.trim() === '') {
      errores.push('El campo "Asunto" es obligatorio.');
   }
   if (inputMensaje.value.trim() === '') {
      errores.push('El campo "Mensaje" es obligatorio.');
   }*/

   if (errores.length > 0) {
      eventoEnvio.preventDefault();

      let msgBox = document.querySelector('.msgBox');
      msgBox.style.display = 'block';
      
      $numError = 0;
      msgBox.innerHTML = '❌ ' + errores.join('<br>❌ ');

      // for (let i = 0; i < errores.length; i++) {
      //    msgBox.innerHTML += '❌ ' + errores[i] + '<br>';
      // }

      return false;
   } else {
      alert('Formulario enviado correctamente.');
      return true;
   }
}