<script>
   // /*
   // Existen diferentes formas de trabajar con objetos en JS (JavaScript).

   // 1.- Literal, es de hecho la forma más común y directa de usar POO en JS.
   // */
   // const persona = {
   //    nombre:"Ana",
   //    edad:30
   // };

   // /*
   // 2.- Constructor new Object(): raramente es usado, pero es válido.
   // */
   // const objAna = new Object(persona);
   // const objAna2 = new Object();
   // objAna2.nombre = 'Ana';

   // /*
   // 3.- Función constructora: es el estilo clásico, antes del estándard ES6.
   // */
   // function Persona(nombre) {
   //    this.nombre = nombre;
   // }
   // const objPepe = new Persona ('Pepe');

   // /*
   // 4.- Clases (ES6+): hoy día, lo más usado, si queremos algo más POO puro.
   // */
   // class Persona {
   //    constructor(nombre) {
   //       this.nombre = nombre;
   //    }
   // }
   // const yo = new Persona('Josema');

   // /*
   // 5.- Object.create(). Crea un objeto con un prototipo concreto.
   // */
   // const proto = {
   //    saludar() {
   //       return `Hola, soy ${this.nombre}`;
   //    }
   // }
   // const tu = Object.create(proto);
   // tu.nombre = 'Tu';

   // /*
   // 6.- Factory Functions: funciones que devuelven objetos sin usar new.
   // */
   // function PersonaFactory(nombre) {
   //    return {
   //       nombre,
   //       saludar() {
   //          return `Hola, soy ${this.nombre}`;
   //       }
   //    }
   // }
   // const el = PersonaFactory('El');

   // /*
   // 7.- Object.assign(): genera un nuevo objeto mezcla de los que intervien.
   // */
   // const base = {
   //    tipo: 'Humano',
   // };

   // // Aquí usamos el operador ... para hacer el .assign() y no de forma directa con el
   // // método.
   // const ana = {...base, nombre: 'Ana'};

   // /*
   //    NOTAS ADICIONALES:
   //    - Los más usados son:
   //       - Literal: si no queremos instanciar objetos diferentes de una misma "clase" y los vamos a usar para guardar
   //       datos que vienen de una petición API o consumo Fetch, objeto de configuración, objetos únicos como un carro
   //       de la compra..., generalmente.

   //       - Clases: si queremos instanciar objetos pero queremos también una aproximación más clásica a la programación
   //       orientada a objetos donde haremos un uso frecuente de métodos.

   //       - Funciones (Constructoras y Factory): queremos instanciar objetos pero de la manera tradicional de JS.
   // */

   // /*
   // PROTOTIPOS:
   // - Son el mecanismo interno que usa JS para todo lo que es programación orientada a objetos en el propio lenguaje. Gracias
   // a esto permite la herencia y la reutilización de métodos.

   // - Cadena de prototipos:
   // Cuando accedemos a una propiedad en un objeto y NO EXISTE, JS, la busca automáticamente en su prototipo, luego en el
   // prototipo del anterior y así sucesivamente hasta llegar a Object.prototype.
   // */
   // const animal = {
   //    respirar() {
   //       return 'Inhala ..., exhala ...';
   //    }
   // }

   // const perro = Object.create(animal);

   // perro.ladrar = function() {
   //    return '¡Guau!';
   // }

   // perro.ladrar();   //  El método .ladrar() es propio de perro.
   // perro.respirar(); //  No existe .respirar() en perro, pero lo encuentra en animal.

   /*
   ¡OJO! Las clases no sustituyen los prototipos. Las clases de hecho:
   */
   // Versión 1 con class:
   class PerroClass {
      ladrar() {
         return '¡Guau!';
      }
   }

   // Versión 2 con función.
   function PerroFunction() {};
   PerroFunction.prototype.ladrar = function() {
      return '¡Guau!';
   }

   // Comprobación:
   const p = new PerroClass();
   alert(p.hasOwnProperty('ladrar'));     // False.
   alert(Object.getPrototypeOf(p) === PerroFunction.prototype);
</script>