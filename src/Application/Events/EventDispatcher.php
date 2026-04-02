<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class EventDispatcher {
      // Protected: como private para acceso directo o clases que no hereden de esta.
      protected array $listeners = [];

      public function suscribe($eventName, $funcionMetodo) {

         /*
         listeners['db.error_conexion'][función para gestionar este evento, por error en dbengine]
         listeners['db.error_conexion'][función para gestionar este evento, por error en dbusuario]
         */
         $this->listeners[$eventName][] = $funcionMetodo;
      }

      public function dispatch($eventName, $data=null) {
         if(!isset($this->listeners[$eventName])) return;

         foreach($this->listeners[$eventName] as $listener) {
            if($listener instanceof ListenerInterface){
               $listener->handle($data);
            } else if(is_callable($listener)) {
               $listener($data);
            }
         }
      }
   }