<!--
                        METHOD CHAINING (PATRÓN DE DISEÑO, ALGORITMO)
-->

<script>
   /*    JAVASCRIPT

   En JS (JavaScript), tenemos tres formas de hacerlo según la estructura que usemos.

   Clases (ES6+):
   ==============
   class QueryBuilder {
      constructor() {
         this._conditions = [];
         this._order = null;
         this._max = null;
      }

      where(condition) {
         this._conditions.push(condition);
         return this; // ← la clave
      }

      orderBy(field) {
         this._order = field;
         return this;
      }

      limit(n) {
         this._max = n;
         return this;
      }

      build() {
         // Este método no devuelve this porque es el terminal
         return {
            conditions: this._conditions,
            order: this._order,
            limit: this._max,
         };
      }
   }

   Uso:
   const query = new QueryBuilder()
   .where('age > 18')
   .where('active = true')
   .orderBy('name')
   .limit(10)
   .build();

   console.log(query);

   Objeto literal (aquí this dentro de los métodos apunta al propio objeto):
   =========================================================================
   const pipeline = {
      _steps: [],

      filter(fn) {
         this._steps.push({ type: 'filter', fn });
         return this;
      },

      map(fn) {
         this._steps.push({ type: 'map', fn });
         return this;
      },

      run(data) {
         // Con función flecha, o "lambda".
         return this._steps.reduce((acc, step) => {
            return step.type === 'filter' ? acc.filter(step.fn) : acc.map(step.fn);
         }, data);

         // Con función anónima
         // return this._steps.reduce(function(acc, step) {
         //    return step.type === 'filter' ? acc.filter(step.fn) : acc.map(step.fn);
         // }, data);

         // Con función declarada externamente:
         // return this._steps.reduce(pipe, data);
      },
   };
   // Función independiente, usada como argumento en la tercera forma de agregar una función como parámetro a un
   // método.
   // function pipe (acc, step) {
   //    return step.type === 'filter' ? acc.filter(step.fn) : acc.map(step.fn);
   // }

   // Uso:
   const result = pipeline.filter(x => x > 2).map(x => x * 10).run([1, 2, 3, 4]);
   console.log(result);
   // → [30, 40]
   /*
   ⚠️ Con objetos literales, si alguien hace const p = pipeline.filter(...), están mutando
   el mismo objeto. Para evitarlo, puedes clonar el estado en cada método:
   return Object.assign({}, this, { _steps: [...this._steps, step] }).

   Función constructora (clásico):
   ===============================
   function Stream(data) {
      this._data = [...data];
   }

   Stream.prototype.filter = function(fn) {
      this._data = this._data.filter(fn);
      return this;
   };

   Stream.prototype.map = function(fn) {
      this._data = this._data.map(fn);
      return this;
   };

   Stream.prototype.toArray = function() {
      return this._data;
   };

   // Uso:
   const result = new Stream([1, 2, 3, 4, 5])
   .filter(x => x % 2 === 0)
   .map(x => x ** 2)
   .toArray();
   // → [4, 16]
   */
</script>

<?php
/*
   PHP

   En PHP el principio es idéntico, pero usamos $this y declaramos el tipo de retorno
   como static (más flexible que self para herencia):

   class QueryBuilder
   {
      private array $conditions = [];
      private ?string $order = null;
      private ?int $max = null;

      public function where(string $condition): static
      {
         $this->conditions[] = $condition;
         return $this; // ← misma idea
      }

      public function orderBy(string $field): static
      {
         $this->order = $field;
         return $this;
      }

      public function limit(int $n): static
      {
         $this->max = $n;
         return $this;
      }

      public function build(): array
      {
         return [
               'conditions' => $this->conditions,
               'order'      => $this->order,
               'limit'      => $this->max,
         ];
      }
   }

   // Uso:
   $query = (new QueryBuilder())
      ->where('age > 18')
      ->where('active = 1')
      ->orderBy('name')
      ->limit(10)
      ->build();
   
   // Peero: self vs static en PHP, el matiz importante en PHP:
   class Base
   {
      public function foo(): static  // static → devuelve la clase hija si se hereda
      {
         return $this;
      }
   }

   class Hijo extends Base {}

   $obj = (new Hijo())->foo();   // con static: instanceof Hijo ✓
                                 // con self:   instanceof Base ✗

   // Usamos static como tipo de retorno si anticipamos que la clase puede extenderse;
   // es la práctica estándar en frameworks como Laravel (donde el Query Builder sigue
   // exactamente este patrón).
*/
?>

<!--
                        BINDING EN JAVASCRIPT
-->
<script>
   /*
      // BINDING se da en JavaScript como parte del lenguaje, no como un algoritmo o
      // patrón de diseño.

      // Es un mecanismo de JavaScript para controlar a qué objeto apunta this en el
      // momento de ejecución. El problema que resuelve es que en JS, this no es fijo
      // — depende de cómo se llama la función, no de dónde se define:

      const obj = {
         nombre: 'Claude',
         saludar() {
            console.log('Hola, soy ' + this.nombre);
         }
      };

      obj.saludar(); // → "Hola, soy Claude"  ✓

      const fn = obj.saludar;
      fn(); // → "Hola, soy undefined"  ✗
            // this ya no apunta a obj, sino a window/undefined
      
      // Ahí es donde entran los tres métodos binding: .call(), .apply(), .bind().
      fn.call(obj);          // llama la función ahora mismo con this = obj
      fn.apply(obj, [args]); // igual que call, pero los args van en un array
      const bound = fn.bind(obj); // devuelve una nueva función con this ya fijado
      bound();               // → "Hola, soy Claude"  ✓

      // La diferencia práctica entre ellos:
               Ejecuta inmediatamente     Acepta argumentos    Devuelve función nueva
      .call()        ✓                      uno a uno                  ✗
      .apply()       ✓                      como array                 ✗
      .bind()        ✗                      uno a uno                  ✓

      // .bind es especialmente útil cuando pasamos un método como callback, porque
      // en ese momento pierdes el contexto del objeto:
      class Temporizador {
         constructor() {
            this.segundos = 0;
         }

         iniciar() {
            // Sin bind, this dentro del callback sería undefined (en strict mode)
            setInterval(this.tick.bind(this), 1000);
         }

         tick() {
            this.segundos++;
            console.log(this.segundos);
         }
      }

      // Otro ejemplo de binding muy recurrente: los event listeners:
      class Contador {
         constructor() {
            this.cuenta = 0;
            this.boton = document.querySelector('#btn');

            // ❌ Sin bind: this dentro de handleClick será el elemento <button>
            // porque el DOM llama la función con el elemento como contexto
            // this.boton.addEventListener('click', this.handleClick);

            // ✅ Con bind: fijamos this a la instancia de Contador
            this.boton.addEventListener('click', this.handleClick.bind(this));
         }

         handleClick() {
            this.cuenta++;
            console.log('Clicks: ' + this.cuenta);
         }
      }

      // Cuando el DOM dispara un evento, llama al callback con this apuntando al elemento HTML que lo disparó,
      // no al objeto donde definiste el método. Por eso this.cuenta sería undefined sin el bind — estás buscando
      // una propiedad cuenta en un <button>.

      // Una alternativa moderna que mucha gente prefiere para evitar el bind explícito es usar una arrow function,
      // ya que estas no tienen su propio this y heredan el del contexto donde fueron definidas:
      constructor() {
         this.cuenta = 0;
         this.boton = document.querySelector('#btn');

         // La arrow function captura el this del constructor
         this.boton.addEventListener('click', () => this.handleClick());
      }
      
      // O definir el propio método como arrow function como propiedad de clase:
      class Contador {
         cuenta = 0;

         // Arrow function como campo de clase: this siempre será la instancia
         handleClick = () => {
            this.cuenta++;
            console.log('Clicks: ' + this.cuenta);
         }

         constructor() {
            document.querySelector('#btn').addEventListener('click', this.handleClick);
         }
      }

      // El tradeoff es que con .bind el método vive en el prototipo (compartido entre instancias), mientras que
      // con la arrow function como campo de clase se crea una copia del método por cada instancia, lo que consume
      // un poco más de memoria si tienes muchos objetos.

      // En PHP esto no existe como problema porque $this siempre apunta a la instancia
      // actual sin ambigüedad — el lenguaje no tiene ese comportamiento dinámico de this.
      // Por eso el binding es un concepto exclusivamente JavaScript (y en general de
      // lenguajes donde las funciones son ciudadanos de primera clase con contexto de
      // ejecución variable).
   */
</script>