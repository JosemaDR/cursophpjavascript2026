<?php
// VALIDACIONES A PARTIR DE FORMULARIOS WEB, se realiza en 3 fases o capas.

/* FASES DE LA VALIDACIÓN EN EL ENVÍO Y PROCESO DE UN FORMULARIO:
  [         CLIENTE      ]         [ SERVIDOR ]
   HTML    ->   JAVASCRIPT     ->     PHP


   ┌─────────────────────────────────────────┐
   │  Capa 1 · HTML5                         │
   │  required, type, minlength, pattern...  │
   │  Rápida, sin código, UX inmediata       │
   └────────────────┬────────────────────────┘
                  │ pasa
   ┌────────────────▼────────────────────────┐
   │  Capa 2 · JavaScript                    │
   │  Validaciones complejas, feedback rico  │
   │  Manipulación del DOM, lógica de UI     │
   └────────────────┬────────────────────────┘
                  │ pasa
   ┌────────────────▼────────────────────────┐
   │  Capa 3 · PHP (backend)                 │
   │  La única realmente segura              │
   │  Sanitización, BD, reglas de negocio    │
   └─────────────────────────────────────────┘

   Las capas 1 y 2 son UX — mejoran la experiencia del usuario pero un atacante puede ignorarlas completamente
   (desactivar JS, manipular peticiones HTTP con herramientas como Postman o Burp Suite). La capa 3 de PHP es
   la única barrera real de seguridad.
*/

/*
EN LA FASE DE VALIDACIÓN DEL FORMULARIO A NIVEL DE HTML:
1.- Usar post en method.
2.- Usar nombre e id en la etiqueta form.
3.- Usar en los campos los tipos de datos adecuados que ya implican unas validaciones automáticas.
4.- Usar los atributos adecuados que nos ofrecerán una validación más precisa.
5.- Usaremos patrones que mejoran la validación.
*/

/*
EN LA FASE DE VALIDACIÓN DEL FORMULARIO A NIVEL DE JAVASCRIPT:
1.- Es necesario capturar el evento onsubmit().
2.- Controlamos los valores de los campos para ver si están vacíos.
3.- Se limpian o sanitizan ante posibles inyecciones de código.
4.- Realizamos validación mediante patrones.
5.- Si no hay errores, se realiza el envío del formulario a la fase de backend (PHP).
*/

/*
EN LA FASE DE VALIDACIÓN DEL FORMULARIO EN EL BACKEND (PHP):
1.- Comprobar que hemos recibido el formulario por los medios previstos.
2.- Sanitizar, limpiar los valores de los campos.
3.- Validación duplicada con regex y filtros.
4.- Hash seguro para claves.
5.- PDO, consultas preparadas: datos siempre vinculados, nunca concatenados.
6.- Uso en base de datos y otros: datos limpios, validados y seguros.
*/

/*
   EJEMPLO DE VALIDACIÓN BÁSICA:
   -----------------------------
   form.addEventListener('submit', function(event) {
      event.preventDefault();

      if (nombre.value.trim() === '') {
         alert('El nombre es obligatorio');
         return;
      }

      if (!email.value.includes('@')) {
         alert('Email no válido');
         return;
      }

      console.log('Formulario válido, procesando...');
   });
*/

/*
   EJEMPLO BÁSICO CON FORMDATA:
   ----------------------------
   form.addEventListener('submit', function(event) {
      event.preventDefault();

      const datos = new FormData(form);

      // Leer valores
      console.log(datos.get('nombre'));

      // Enviar directamente...
   });
*/

/*
   ENVÍO DEL FORMULARIO UNA VEZ VALIDADO, PARA QUE CONTINÚE SU CICLO DE VIDA.

   Esto lo conseguimos con los métodos del formulario .submit() o .requestSubmit().

                                    submit()     requestSubmit()
   Dispara el evento submit         ❌ No       ✅ Sí
   Ejecuta validación HTML5         ❌ No       ✅ Sí
   Permite preventDefault()         ❌ No       ✅ Sí
   Soporte navegadores              Universal    Moderno (IE no)

   EJEMPLO:
   --------
   const form = document.getElementById('miFormulario');

   // submit() — salta validaciones y listeners, envío directo
   form.submit();

   // requestSubmit() — respeta el flujo completo
   form.requestSubmit();

   // También puede recibir un botón submit específico como argumento
   const boton = document.querySelector('button[type="submit"]');
   form.requestSubmit(boton);

   La diferencia clave es que submit() es un envío forzado que ignora todo, mientras que requestSubmit() se comporta
   exactamente como si el usuario hubiese pulsado el botón de envío.
*/

/*
   EJEMPLO AVANZADO EN FASES 1 Y 2 (HTML Y JS) CON PATRONES:

   // ===========> HTML*/?>
   <form id="registro" action="procesar.php" method="POST">

      <!-- Solo letras y espacios, entre 2 y 50 caracteres -->
      <input type="text" id="nombre" name="nombre"
               pattern="[A-Za-z\s]{2,50}"
               title="Solo letras, entre 2 y 50 caracteres"
               required />

      <!-- Email estándar -->
      <input type="email" id="email" name="email"
               pattern="[^\s@]+@[^\s@]+\.[^\s@]{2,}"
               title="Formato: usuario@dominio.com"
               required />

      <!-- Contraseña: mín. 8 chars, mayúscula, minúscula, número y especial -->
      <input type="password" id="password" name="password"
               pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
               title="Mínimo 8 caracteres, mayúscula, minúscula, número y símbolo"
               required />

      <!-- Teléfono español: 6xx, 7xx, 9xx — 9 dígitos -->
      <input type="tel" id="telefono" name="telefono"
               pattern="[679][0-9]{8}"
               title="Teléfono español válido (9 dígitos)"
               required />

      <button type="submit">Registrar</button>
   </form>

   <script>
   // ===========> JAVASCRIPT
   const REGEX = {
      nombre:    /^[A-Za-z\s]{2,50}$/,
      email:     /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i,
      password:  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/,
      telefono:  /^[679]\d{8}$/
   };

   const MENSAJES = {
      nombre:   'Solo letras (con tildes), entre 2 y 50 caracteres',
      email:    'Formato no válido. Ejemplo: usuario@dominio.com',
      password: 'Mínimo 8 caracteres, con mayúscula, minúscula, número y símbolo',
      telefono: 'Teléfono español: 9 dígitos comenzando por 6, 7 o 9'
   };

   const form = document.getElementById('registro');

   // Validación en tiempo real campo a campo
   Object.keys(REGEX).forEach(campo => {
      const input = document.getElementById(campo);

      input.addEventListener('blur', () => validarCampo(campo, input));
      input.addEventListener('input', () => {
         if (input.classList.contains('error')) validarCampo(campo, input);
      });
   });

   function validarCampo(campo, input) {
      const valor = input.value.trim();
      const valido = REGEX[campo].test(valor);

      input.classList.toggle('error', !valido);
      input.classList.toggle('ok', valido);

      let msg = input.parentElement.querySelector('.msg-error');
      if (!msg) {
         msg = document.createElement('span');
         msg.className = 'msg-error';
         input.parentElement.appendChild(msg);
   }

   msg.textContent = valido ? '' : MENSAJES[campo];
   return valido;
   }

   // Validación global al hacer submit
   form.addEventListener('submit', function(event) {
      event.preventDefault();

      const camposValidos = Object.keys(REGEX).map(campo => {
         const input = document.getElementById(campo);
         return validarCampo(campo, input);
      });

      if (camposValidos.every(Boolean)) {
         form.requestSubmit();
      }
   });
   </script>

   <?php
   // Mismas regex que en JS, adaptadas a sintaxis PHP
   const REGEX = [
      'nombre'   => '/^[A-Za-z\s]{2,50}$/',
      'email'    => '/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i',
      'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
      'telefono' => '/^[679]\d{8}$/',
   ];

   $errores = [];

   // 1. Sanitización previa (limpiar antes de validar)
   $datos = [
      'nombre'   => htmlspecialchars(trim($_POST['nombre']   ?? ''), ENT_QUOTES, 'UTF-8'),
      'email'    => filter_var(trim($_POST['email']          ?? ''), FILTER_SANITIZE_EMAIL),
      'password' => trim($_POST['password']                  ?? ''),
      'telefono' => preg_replace('/\s+/', '', $_POST['telefono'] ?? ''), // Elimina espacios
   ];

   // 2. Validación con regex
   foreach (REGEX as $campo => $patron) {
      if (!preg_match($patron, $datos[$campo])) {
         $errores[$campo] = "El campo '$campo' no tiene un formato válido";
      }
   }

   // 3. Validación adicional de email con PHP nativo
   if (empty($errores['email']) && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
      $errores['email'] = 'Email no válido según RFC';
   }

   // 4. Si hay errores, responder
   if (!empty($errores)) {
      // En una API: json_encode($errores)
      // En formulario clásico: redirigir o mostrar
      foreach ($errores as $campo => $msg) {
         echo htmlspecialchars($msg) . "<br>";
      }
      exit;
   }

   // A partir de aquí, datos validados y seguros
   // Siguiente paso: prepared statements para la BD
   echo "Datos válidos. Procesando...";
   ?>

/*
   PHP. FILTRADOS VAR E INPUT
   --------------------------

   // filter_var()  → filtra una variable ya en memoria
   // filter_input() → lee directamente de $_POST, $_GET, etc. (más seguro)

   // SANITIZAR — limpia el valor, elimina caracteres no deseados
   $nombre   = filter_var($_POST['nombre'],   FILTER_SANITIZE_SPECIAL_CHARS);
   $email    = filter_var($_POST['email'],    FILTER_SANITIZE_EMAIL);
   $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);

   // VALIDAR — devuelve el valor si es válido, false si no lo es
   $email_ok    = filter_var($email, FILTER_VALIDATE_EMAIL);
   $telefono_ok = filter_var($telefono, FILTER_VALIDATE_INT, [
   'options' => ['min_range' => 600000000, 'max_range' => 999999999]
   ]);

   // filter_input() — evita manipulaciones previas de $_POST
   $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
*/

/*
   PHP. FILTROS COMPLEJOS: filtros, regex y prepared statements
   ------------------------------------------------------------

<?php
// ============================================================
// 1. SANITIZACIÓN — limpiar antes de tocar nada
// ============================================================

$datos = [
  'nombre'   => filter_input(INPUT_POST, 'nombre',   FILTER_SANITIZE_SPECIAL_CHARS),
  'email'    => filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL),
  'password' => trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)),
  'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT),
];

// ============================================================
// 2. VALIDACIÓN — regex + filtros nativos
// ============================================================

const REGEX = [
  'nombre'   => '/^[A-Za-z\s]{2,50}$/',
  'email'    => '/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i',
  'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
  'telefono' => '/^[679]\d{8}$/',
];

$errores = [];

foreach (REGEX as $campo => $patron) {
  if (empty($datos[$campo])) {
    $errores[$campo] = "El campo '$campo' es obligatorio";
    continue;
  }
  if (!preg_match($patron, $datos[$campo])) {
    $errores[$campo] = "El campo '$campo' no tiene un formato válido";
  }
}

// Validación semántica adicional de email
if (!isset($errores['email']) && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
  $errores['email'] = 'El email no es válido según RFC';
}

if (!empty($errores)) {
  // En API REST devolvería json_encode(['errores' => $errores])
  foreach ($errores as $msg) {
    echo htmlspecialchars($msg) . "<br>";
  }
  exit;
}

// ============================================================
// 3. HASH DE CONTRASEÑA — nunca se guarda en texto plano
// ============================================================

$password_hash = password_hash($datos['password'], PASSWORD_ARGON2ID, [
  'memory_cost' => 65536, // 64MB
  'time_cost'   => 4,
  'threads'     => 2
]);

// ============================================================
// 4. PREPARED STATEMENTS — PDO
// ============================================================

   $dsn = 'mysql:host=localhost;dbname=mi_base;charset=utf8mb4';

   try {
   $pdo = new PDO($dsn, 'usuario', 'contraseña', [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false, // Prepared statements reales
   ]);

   // Comprobar si el email ya existe
   $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
   $stmt->execute([':email' => $datos['email']]);

   if ($stmt->fetch()) {
      echo 'Este email ya está registrado';
      exit;
   }

   // Inserción segura
   $stmt = $pdo->prepare('
      INSERT INTO usuarios (nombre, email, password, telefono, creado_en)
      VALUES (:nombre, :email, :password, :telefono, NOW())
   ');

   $stmt->execute([
      ':nombre'   => $datos['nombre'],
      ':email'    => $datos['email'],
      ':password' => $password_hash,
      ':telefono' => $datos['telefono'],
   ]);

   $id_nuevo = $pdo->lastInsertId();
   echo "Usuario registrado con ID: $id_nuevo";

   } catch (PDOException $e) {
   // Nunca mostrar el error real al usuario
   error_log($e->getMessage()); // Se guarda en el log del servidor
   echo 'Error interno. Inténtalo más tarde.';
   }
?>
*/

/*
DIFERENCIA ENTRE ONSUBMIT Y ADDEVENTLISTENER:

   // ONSUBMIT()
   // <etiqueta html onclick="codigo javascript que fuera">
   // .onsubmit() — propiedad del elemento, SOLO ADMITE UN HANDLER
   form.onsubmit = function(event) {
      event.preventDefault();
      console.log('Validación A');
   };

   // Esto SOBREESCRIBE el anterior, el primero se pierde
   form.onsubmit = function(event) {
      event.preventDefault();
      console.log('Validación B'); // Solo se ejecuta este
   };

   // ADDEVENTLISTENER
   // addEventListener — ACUMULA HANDLERS, no sobreescribe
   form.addEventListener('submit', function(event) {
      event.preventDefault();
      console.log('Validación A'); // Se ejecuta
   });

   form.addEventListener('submit', function(event) {
      console.log('Validación B'); // También se ejecuta
   });

   // Razones concretas para preferir addEventListener():

   // 1. Múltiples listeners sobre el mismo evento. En una aplicación real es habitual
   // que distintos módulos necesiten reaccionar al mismo evento sin pisarse entre sí:
   // validación, analytics, UI feedback...

   // 2. Control fino con removeEventListener():
         function validarFormulario(event) {
            event.preventDefault();
         // ...
         }

         form.addEventListener('submit', validarFormulario);

         // Más adelante se puede eliminar con precisión
         form.removeEventListener('submit', validarFormulario);

         // Con onsubmit solo puedes anularlo todo: form.onsubmit = null;
      
   // 3. Opciones avanzadas en el tercer parámetro.
      // once: se ejecuta solo la primera vez y se elimina solo:
      form.addEventListener('submit', manejarEnvio, { once: true });

      // capture: intercepta el evento en fase de captura:
      form.addEventListener('submit', validar, { capture: true });

      // passive: promesa de no llamar preventDefault(), mejora rendimiento.
      // (más útil en scroll/touch que en submit)
      document.addEventListener('scroll', handler, { passive: true });

   // 4. Separación de responsabilidades. onsubmit mezcla comportamiento con
   // estructura si se usa inline en el HTML:
      <!-- Acoplamiento fuerte, difícil de mantener -->
      <form onsubmit="validar()">

      <!-- addEventListener mantiene HTML y JS completamente separados -->
      <form id="registro">

   // ¿Cuándo usar onsubmit?
   // Hay un caso legítimo: cuando explícitamente quieres garantizar que solo existe
   // un handler y que cualquier asignación posterior lo reemplaza. Es un mecanismo
   // de control, no una limitación.
   // También es algo más conciso para scripts simples o prototipos rápidos donde la
   // escalabilidad no importa.
*/


?>
<form action="" method="post" name="frmPrueba" id="frmPrueba">
   <input type="text" name="nombre" id="nombre" minlength="3" maxlength="25" required /><br />
   <input type="number" name="edad" id="edad" min="1" value="1" required /><br />
   <input type="text" name="telf" id="telf" pattern="\+\(\d+\)\d{9}" required /><br />
   <input type="date" name="fecha" id="fecha" required /><br />
   
   <input type="submit" value="Enviar" name="frmEnviar" id="frmEnviar" />
</form>
<section id="capaErrores" style="border:1px solid red;border-radius:10px;color:red;display:none;padding:10px;"></section>

/*
EN LA FASE DE VALIDACIÓN DEL FORMULARIO A NIVEL DE JAVASCRIPT:
*/
<script>
   const frmPrueba = document.querySelector('#frmPrueba');
   frmPrueba.onsubmit = function(event) {
      const nombre = document.querySelector('#nombre');
      const edad = document.querySelector('#edad');
      const telf = document.querySelector('#telf');
      const fecha = document.querySelector('#fecha');
      const errores = [];

      event.preventDefault();

      if(nombre.value.length === 0) {//if(nombre.value.trim() === '') {
         errores.push('Debe introducir un nombre válido');
      }
      if(edad.value <= 0) {
         errores.push('Debe introducir una edad correcta');
      }

      if(errores.length > 0) {
         const capaErrores = document.querySelector('#capaErrores');
         capaErrores.style.display = 'block';

         capaErrores.innerHTML = errores.join('<br />');
      } else {
         frmPrueba.submit();
      }

      //console.log(frmPrueba, nombre, edad, telf, fecha);
   }
</script>

<?php
   echo '<pre>';
   var_dump($_POST);
   echo '</pre>';