<?php 
	require_once "DAO_General.php";
	
	
	class Anunciante {

		private $nick;
		private $fecha_alta;
		private $cif;
				
		public function __construct(){
			// Esta es la estructura si necesitamos tener varias "contructoras". 
			$arguments = func_get_args();
			$num = sizeof($arguments);
			
			switch($num){
				case 0;
					break;
				case 1:
					$this->nick 			= $arguments[0];
					$this->fecha_alta 		= date("Y-m-d");
					break;
				case 2:
					$this->nick 			= $arguments[0];
					$this->fecha_alta 		= date("Y-m-d");
					$this->cif 				= $arguments[1];
				case 3:
					$this->nick 			= $arguments[0];
					$this->fecha_alta 		= $arguments[1];
					$this->cif 				= $arguments[2]; 
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
		
		/*Obtener usuario por nick o por correo*/
		public function obtenerAnunciante($campo){
			$usuario = null;
			$result = dameAnunciante($campo, $this->$campo);
			
			if($result->num_rows != 0){
				$row = $result->fetch_row();
				$usuario = $this->montaAnunciante($row);			
			}
			
			return $usuario;
		}
		
		public function registrarAnunciante(){
			// Ya se ha comprobado previamente que no existia el usuario, por lo que ahora se registran sus datos de anunciante
			creaAnunciante($this);
		}
		
		public function loginAnunciante(){
			// Ya se a comprobado previamente que existe el usuario, por lo que ahora se carga sus datos de anunciante
			$result = dameAnunciante("nick", $this->nick);
			$row = $result->fetch_row();
			$anunciante = $this->montaAnunciante($row);									
			return $anunciante;
		}
		
		public function modificarAnunciante(){
			modificarAnunciante($this);
			$_SESSION["cif"] 		 = $this->cif;
			$_SESSION["fecha_alta"]  = $this->fecha_alta;
			
		}
		
		public function montaAnunciante($row){
			$usuario = new Usuario(	$row[0], 	// nick
									$row[1], 	// fecha alta
									$row[2]		// cif
									);			
			return $usuario;
		}
	}

?>