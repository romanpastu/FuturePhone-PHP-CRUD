<?php
//include 'libs/settings.config.php'; 
    include 'settings.config.php'; 
    require_once("DBConnection.php");
    require_once("Usuario.php");
    
    class Sesion{
        private $usuario;
        private $time_expire = 50000;
        private static $instancia = null;
        private $dbconfig;

        private function __construct(){
            $this->dbconfig = dbConfig();
        }
        
        private function __clone(){}

        public function getUsuario(){
            return $this->usuario;
        }

        public function close(){
            $_SESSION = [];
            //session_detroy();
        }  
        
        public static function getInstance()
		{   
            

			session_start() ;

			// comprobamos 
			if (isset($_SESSION["_sesion"])):
				self::$instancia = unserialize($_SESSION["_sesion"] ) ;
			else:
				if (self::$instancia===null) 
					self::$instancia = new Sesion() ;
			endif ;

			// devolvemos la instancia
			return self::$instancia ;
        }
        
        public function login(string $dni, string $pas):bool
        {
            //instanciar la clase Database
            $db = new DBConnection($this->dbconfig);

            //$sql = "SELECT * FROM usuario WHERE DNIUsu ='$dni' AND PwdUsu=MD5('$pas');";

            $param = [$dni, $pas];
            $sql = "SELECT * FROM usuario WHERE DNIUsu =?  AND PwdUsu=MD5(?);";


           if($db->runQueryPDO($sql, $param)->fetchAll()){
               $this->usuario = $db->runQueryPDO($sql, $param)->fetchObject('Usuario');

               $_SESSION["time"] = time();
               $_SESSION["_sesion"] = serialize(self::$instancia);
    

               return true;
           }else{
               return false;
           }
        }

           public function isExpired():bool
           {
            return (time() - $_SESSION["time"] > $this->time_expire) ; 
           }

           public function isLogged():bool
           {
               return !empty($_SESSION);
           }

           public function checkActiveSession():bool
		{
			if ($this->isLogged())
				if (!$this->isExpired()) return true ;
			
			return false ;
        }
        
        public function redirect(string $url)
		{
			header("Location: $url") ;
			die() ;
        }
        
        public function __sleep()
		{
			return ["usuario", "instancia"] ;
		}



        }



    

