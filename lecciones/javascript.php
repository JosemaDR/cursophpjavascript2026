<!DOCTYPE html>
<html>
   <head>
      <title>Lección sobre JavaScript</title>
      <script>
         otraVariable = 79787.545;
         var otraVar = null;
         let domDIV = null;

         /*
         function seleccionarPruebasHTML() {
            return document.getElementById('pruebas');
         }
         htmlPruebas = seleccionarPruebasHTML();
         */

         document.addEventListener("DOMContentLoaded", function() {
            domDIV = document.getElementById('aVerQuePasa');
            domDIV.onclick = function() {
               //nuevaVentana = window.open();
               //this.innerHTML = '<p>Texto dentro del párrafo</p>Texto fuera del párrafo pero dentro del div';
               //this.outerHTML = '<p>Texto dentro del párrafo</p>Texto fuera del párrafo pero dentro del div';
               //this.textContent = '<p>Texto dentro del párrafo</p>Estoljkhlkjhjkh ljhk ';
               window.otraVariable = 'AASDFADFADSFA';
               console.warn(window.otraVariable);
            };
         });

         // window.onload = function() {
         //    domDIV = document.getElementById('aVerQuePasa');
         //    domDIV.onclick = function() {
         //       nuevaVentana = window.open();
         //    };
         //    otraVariable = 'VALOR DE OTRA VARIABLE';
         // };
      </script>
      <script src="archivo.js"></script>
   </head>
   <body>
      <button onclick="alert('Respondiendo al evento onclick del botón HTML');">
         Púlsame!!!
      </button>
      <div>
         <a href="javascript:alert('Respondiendo al evento onclick de HIPERENLACE');">¡¡¡PÚLSAME!!!</a>
      </div>

      <div id="pruebas">
         <p>Este es el texto del párrafo.</p>
      </div>

      <div>
         <?php
            echo '<button onmousemove="alert(\'Respondiendo al evento onmousemove del botón dinámico desde PHP\');" >MUEVE EL RATÓN POR AQUÍ</button>';
         ?>
      </div>
      <!--
      onclick="miVentana = window.open();miVentana.document.write('<h1>HTML CREADO DESDE JAVASCRIPT</h1');">
      
      <div style="margin:10px;padding:50px;background-color:navy;color:white;border-radius:10px;"
         onclick="console.info(htmlPruebas);">
         A VER QUE PASA
      </div>
      -->
      <div id="aVerQuePasa" style="margin:10px;padding:50px;background-color:navy;color:white;border-radius:10px;">
         A VER QUE PASA
      </div>
   </body>
</html>