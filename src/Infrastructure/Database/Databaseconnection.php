<?php
   defined('APP_ROOT') or header('Location: ../index.php');

   class PDOAPP {
      private $urlConexion = '';
      private $dbEngine = '';
      private $dbHost = '';
      private $dbUser = '';
      private $dbPassword = '';
      private $dbName = '';

      public function __construct() {
         $this->dbEngine = Config::getDBEngine();
         $this->dbHost = Config::getDBHost();
         $this->dbUser = Config::getDBUser();
         $this->dbPassword = Config::getDBPassword();
         $this->dbName = Config::getDBName();
         $this->setUrlConexion();
      }

      public function conectar() {
         try {
            $conn = new PDO($this->urlConexion, Config::getDBUser(), Config::getDBPassword());
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
         } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
         }
      }

      public function setDBEngine($engine) {
         $this->dbEngine = $engine;
      }
      public function setDBHost($host) {
         $this->dbHost = $host;
      }
      public function setDBUser($user) {
         $this->dbUser = $user;
      } 
      public function setDBPassword($password) {
         $this->dbPassword = $password;
      }
      public function setDBName($dbname) {
         $this->dbName = $dbname;
      }

      public function setUrlConexion() {
         $this->urlConexion = $this->dbEngine . ':host=' . Config::getDBHost() . ';dbname=' . Config::getDBName();
      }
   }