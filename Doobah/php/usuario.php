<?php 
	require_once "DAO_General.php";
	require_once "anunciante.php";
	
	if(isset($_GET["funcion"])){
		$funcion = $_GET["funcion"];
		if($funcion == "existeUsuario"){
			if(isset($_GET["param1"]) && isset($_GET["param2"])){
				 if($_GET["param1"] == "nick" || $_GET["param1"]=="email"){
				 $campo = Usuario::limpiar_cadena($_GET["param1"]);
				 $valor = Usuario::limpiar_cadena($_GET["param2"]);
				 $dis = existeUsuario( $campo, $valor );
				}
			}
		}		
	}
	
	function existeUsuario($campo, $valor){
		$result = dameUsuario($campo, $valor);	
		$disponibilidad  = ($result->num_rows == 0) ? "disponible":"existe";	
		return $disponibilidad;
	}
	
	
	
	class Usuario {

		private $nick;
		private $password;
		private $fecha_nac;
		private $nombreCompleto;
		private $tipo;
		private $descripcion;
		private $avatar;
		private $ciudad;
		private $email;
		private $salt;
		private $isAdmin;
				
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 1:
					$this->nick 			= $arguments[0];
					break;
				case 2:
					$this->nick 			= $arguments[0];
					$this->password 		= $arguments[1];
					break;
				case 5:
					$this->nick 			= $arguments[0];
					$this->password 		= $arguments[1];
					$this->email 			= $arguments[2];              
					$this->tipo 			= $arguments[3];
					$this->avatar			= $arguments[4];
					break;				
				case 10:
					$this->nick 			= $arguments[0];
					$this->password 		= $arguments[1];
					$this->fecha_nac 			= $arguments[2];
					$this->nombreCompleto 	= $arguments[3];
					$this->tipo 			= $arguments[4];
					$this->descripcion 		= $arguments[5];				
					$this->avatar 			= $arguments[6];
					$this->ciudad 			= $arguments[7];
					$this->email 			= $arguments[8];
					$this->salt 			= $arguments[9];
					break;
				case 11:
					$this->nick 			= $arguments[0];
					$this->password 		= $arguments[1];
					$this->fecha_nac 		= $arguments[2];
					$this->nombreCompleto 	= $arguments[3];
					$this->tipo 			= $arguments[4];
					$this->descripcion 		= $arguments[5];				
					$this->avatar 			= $arguments[6];
					$this->ciudad 			= $arguments[7];
					$this->email 			= $arguments[8];
					$this->salt 			= $arguments[9];
					$this->isAdmin 			= $arguments[10];
					break;
				default:
					break;
			}
		}
		
		
		public function __get($property){
			if(property_exists($this, $property)){
				return $this->$property;
			}
		}

		public function __set($property, $value){
			if(property_exists($this, $property)){
				$this->$property = $value; 
			}
		}
		
		public function registrarUsuario(){
			$registrado = false;
			$usuario = $this->obtenerUsuario("nick");
			
			if(is_null($usuario) && is_null($this->obtenerUsuario("email"))){
				$salt = $this->generarSalt();
				$hashPass = $this->encriptarPass($this->password, $salt);
				$this->password = $hashPass;
				$this->salt = $salt;	
				creaUsuario($this);
				$registrado = true;			
			}
			
			return $registrado;
		}
		
		/*Obtener usuario por nick o por correo*/
		public function obtenerUsuario($campo){
			$usuario = null;
			$result = dameUsuario($campo, $this->$campo);
			
			if($result->num_rows != 0){
				$row = $result->fetch_row();
				$usuario = $this->montaUsuario($row);			
			}
			
			return $usuario;
		}
		
		
		public function loginUsuario(){
			$usuario = $this->obtenerUsuario("nick");
			if (!is_null($usuario)){
				$tmpPass = $this->encriptarPass($this->password, $usuario->salt);
				// Compruebo las hash de las contraseñas
				if(!$this->comprobarPass($tmpPass, $usuario->password)){
					$usuario = null;
				}
			}			
			return $usuario;
		}
		
		public function actualizarPerfil(){
			modificarUsuario($this);
			$_SESSION["nick"] 			= $this->nick;
			$_SESSION["fecha_nac"] 		= $this->fecha_nac;
			$_SESSION["nombreCompleto"] = $this->nombreCompleto;
			$_SESSION["tipo"] 			= $this->tipo;
			$_SESSION["descripcion"] 	= $this->descripcion;
			$_SESSION["ciudad"] 		= $this->ciudad;
			$_SESSION["email"] 			= $this->email;
			$_SESSION["avatar"] 		= $this->avatar;
		}
		
		public function regenerarPass(){
			$salt = $this->generarSalt();
			$newPass = $this->generateRandomString(15);
			$hashPass = $this->encriptarPass($newPass, $salt);
			$this->password = $hashPass;
			$this->salt = $salt;	
			modificarUsuario($this);
			
			return $newPass;
		}
		
		public function comprobarPass($pass1, $pass2){
			return ($pass1 == $pass2);
		}
		
		
		
		public static function montaUsuario($row){
			$usuario = new Usuario(	$row[0], 	// nick
									$row[1], 	// hash del password
									$row[2],	// fecha_nac 
									$row[3], 	// nombreCompleto
									$row[4], 	// tipo
									$row[5], 	// descripcion
									$row[6],	// avatar
									$row[7], 	// ciudad
									$row[8],  	// email
									$row[9]		// salt
									);			
			return $usuario;
		}
		
		public static function montaUsuarioLargo($row){
			$usuario = new Usuario(	$row[0], 	// nick
									$row[1], 	// hash del password
									$row[2],	// fecha_nac 
									$row[3], 	// nombreCompleto
									$row[4], 	// tipo
									$row[5], 	// descripcion
									$row[6],	// avatar
									$row[7], 	// ciudad
									$row[8],  	// email
									$row[9],	// salt
									$row[12]	//idAdmin
									);			
			return $usuario;
		}
		
		
		// Generacion de la sal para la contraseña
		public function generarSalt(){
			$characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$salt = "";
			for($i = 0; $i < 22; $i++){
				$salt .= $characters[mt_rand(0, 61)];
			}
			$salt = '$2y$10$'.$salt;
			return $salt;
		}
		
	function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		// Generamos una cadena de "lenght" caracteres.
		$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		// Aplicamos md5 sobre esa cadena para regenerar otra cadena aleatoria.
		$randomString = md5($randomString);
		// Extraemos los 15 primeros caracteres
		$randomString = substr($randomString, 0, 15);
		return $randomString;
	}
	
		// Encriptación usando Blowfish
		public function encriptarPass($pass, $salt){
			$hash = crypt($pass, $salt);	
			return $hash;
		}
		
		public static function limpiar_cadena($cadena) {
			$cadena = trim($cadena);
			$cadena = stripslashes($cadena);
			$cadena = htmlspecialchars($cadena);
			return $cadena;
		}
	}
?>